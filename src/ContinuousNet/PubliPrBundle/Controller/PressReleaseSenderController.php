<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\Contact;
use ContinuousNet\PubliPrBundle\Entity\Email;
use ContinuousNet\PubliPrBundle\Entity\EmailCampaign;
use ContinuousNet\PubliPrBundle\Entity\Newsroom;
use ContinuousNet\PubliPrBundle\Entity\PressRelease;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\View\View as FOSView;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use Doctrine\ORM\Query\Expr\Join;
use Hip\MandrillBundle\Message;
use Hip\MandrillBundle\Dispatcher;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
use ContinuousNet\PubliPrBundle\Services\Settings;

class PressReleaseSenderController extends FOSRestController
{

    private $emailSendingStatus = array('rejected' => 'Error', 'sent' => 'Sent', 'initialized' => 'Initialized');
    /**
     * @Post("/PrSender")
     * @param $request
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function sendAction(Request $request)
    {
       $data = array('idgroup' => $request->request->get('cgIds'), 'id' => $request->request->get('prId'));
        $em = $this->getDoctrine()->getManager();
        $qb =$em->createQueryBuilder();
        $qb->from('PubliPrBundle:PressRelease', 'pr_');
        $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\Newsroom', 'newsroom', \Doctrine\ORM\Query\Expr\Join::WITH , 'pr_.newsroom = newsroom.id');
        $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\User', 'user', Join::WITH, 'pr_.creatorUser = user.id');
        $qb->andWhere('pr_.id = :id')->setParameter('id', $request->request->get('prId'));
        $qb->select('pr_');
        $pressRelease = $qb->getQuery()->getResult();
        $one = $pressRelease[0];
        $emailTemplate = $this->getEmailTemplate('pr_email', $em);
        if(!$emailTemplate)
        {
            return false;
        }
        //get list contact emails
        $contactQuery = $em->createQueryBuilder();
        $contactQuery->from('PubliPrBundle:Contact', 'ct_');
        $contactQuery->where('ct_.contactGroup IN (:groups)')->setParameter('groups', $request->request->get('cgIds'));
        $contactQuery->select('ct_');
        $contacts = $contactQuery->getQuery()->getResult();
        //try to send press release to founded contact list
        if(is_null($contacts)) {
            return false;
        }

        $dispatcher = $this->get('hip_mandrill.dispatcher');
        $message = new Message();
        $message->setFromEmail($one->getNewsroom()->getName())
            ->setFromEmail($one->getNewsroom()->getEmail())
            ->setSubject($emailTemplate->getSubject())
            ->setHtml($this->parseEmailTemplate($emailTemplate->getBody(), $one))
            ->setFromEmail($emailTemplate->getFromEmail())
            ->setReplyTo($emailTemplate->getReplyToEmail())
            ->setTrackClicks(true)
            ->setTrackOpens(true)
            ->addTag($one->getSlug());
        foreach ($contacts as $contact) {
            $message->addTo($contact->getEmail(), $contact->getFirstName() . ' ' . $contact->getLastName());
        }
        $result = $dispatcher->send($message);
        if($result) {
            foreach ($contacts as $contact) {
                $keyResult = array_search($contact->getEmail(), array_column($result, 'email'));
                $this->saveEmailsContact($one, $contact, $result[$keyResult]['status'], $em);
            }
            $this->saveEmailCampaign($one, $request->request->get('cgIds'), $em);
            $em->flush();
            return true;
        }
        else
        {
            return false;
        }
        
    }

    /**
     * @POST("/PrStat")
     * @param $request
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function StatisticAction(Request $request)
    {
        try {
            $data = array(
                'periode'=> array(),
                'result' => array(),
                'total_sent' => 0,
                'total_opens' => 0,
                'total_clicks' => 0,
                'unique_opens' => 0,
                'unique_clicks' => 0
            );
            $em = $this->getDoctrine()->getManager();
            //$pressRelease = new PressRelease() ;
            $pressRelease =  $em->getRepository('PubliPrBundle:PressRelease')->find($request->request->get('prId'));
            $apiKey = $this->getParameter('hip_mandrill.api_key');
            $mandrill = new \Mandrill($apiKey);
            $result = $mandrill->tags->info($pressRelease->getSlug());
            if($result){
                $status = array('sent', 'rejects', 'opens');
                $data['periode'] = array_keys($result['stats']);

                $data['total_sent']     = $result['sent'];
                $data['total_opens']    = $result['opens'];
                $data['total_clicks']   = $result['clicks'];
                $data['unique_opens']   = $result['unique_opens'];
                $data['unique_clicks']  = $result['unique_clicks'];
                $data['total_sent']     = $result['sent'];
                foreach ($status as $stat){
                    $tmp = array(
                        'name' => $stat,
                        'data' => array()
                    );
                    foreach ($data['periode'] as $periode){
                        array_push($tmp['data'], $result['stats'][$periode][$stat]);
                    }
                   array_push($data['result'], $tmp);
                }
                $data['periode'] = array_map(function($str){
                    return str_replace('_', ' ', $str);
                }, $data['periode']);
                return $data;
            }

        }catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @POST("/PrStatEmail")
     * @param $request
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function statsByEmailAction(Request $request){

        try{
            $data = array(
                'inlineCount' => 0,
                'results' => array()
            );
            $em = $this->getDoctrine()->getManager();
            $pressRelease =  $em->getRepository('PubliPrBundle:PressRelease')->find($request->request->get('prId'));
            $apiKey = $this->getParameter('hip_mandrill.api_key');
            $mandrill = new \Mandrill($apiKey);
            $query = '*';
            $start_date = new \DateTime($request->request->get('startDate') );
            $start_date = $start_date->format('Y-m-d');
            $end_date = new \DateTime($request->request->get('endDate') );
            $end_date = $end_date->format('Y-m-d');
            $tags = array(
                $pressRelease->getSlug()  // search by TAG mapped with pressRelease slug, we have addedthe tag in the send call!
            );
            $senders = array(); // filter by sender emails [put them in array]
            $api_keys = array($apiKey);
            $limit = 100; // limit off search not used because we can't use the offset params!
            $result = $mandrill->messages->search($query, $start_date, $end_date,$tags, $senders, $api_keys, $limit);
            if($result){
                $datetime = new \DateTime();
                foreach($result as $email){
                    if(array_search($email['email'], array_column($data['results'], 'email'))){

                    }
                    else{
                        $data['results'][] = array(
                            'email' => $email['email'],
                            'sent_date' => $datetime->setTimestamp($email['ts'])->format('Y-m-d H:i:s'),
                            'opens' => $email['opens'],
                            'state' => $email['state'],
                            'clicks' => $email['clicks']
                        );
                    }
                }
                $data['inlineCount'] = count($data['results']);
                $offset = $request->request->get('offset');
                $limit  = $request->request->get('limit');
                $data['results'] = array_slice($data['results'],$offset, $limit);
            }
            return $data;
        }catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function saveEmailsContact( PressRelease $pressRelease,Contact $contact,$sendingStatus, EntityManager $em)
    {
        $email = new Email();
        $email->setContact($contact);
        $email->setPressRelease($pressRelease);
        $email->setEmail($pressRelease->getNewsroom()->getEmail());
        $email->setCreatorUser($this->getUser());
        $email->setSection('section 1');
        $email->prePersist();
        $email->setSendingStatus($this->emailSendingStatus[$sendingStatus]);
        $em->persist($email);
        return $email;
        
    }

    private function saveEmailCampaign(PressRelease $pressRelease, $cgIds ,EntityManager $em)
    {
        $emailCampaign = new EmailCampaign();
        $emailCampaign->setPressRelease($pressRelease);
        foreach ($cgIds as $cg)
        {
            $emailCampaign->addContactGroup($em->getRepository('PubliPrBundle:ContactGroup')->find($cg));
        }
        $emailCampaign->setSendingDateTime(new \DateTime('now'));
        $emailCampaign->setSendNow(true);
        $emailCampaign->setName($pressRelease->getTitle());
        $emailCampaign->setDescription($pressRelease->getDescription());
        $emailCampaign->setCreatorUser($this->getUser());
        $emailCampaign->prePersist();
        $em->persist($emailCampaign);
    }

    private function getEmailTemplate($slug, EntityManager $em)
    {
        $emailTemplate = $em->getRepository('PubliPrBundle:EmailTemplate')->findOneBySlug($slug);
        return (!is_null($emailTemplate)) ? $emailTemplate : false;
    }

    private function prepareDataEmailTemplate(PressRelease $pressRelease)
    {
        $date = new \DateTime('now');
        $values = array(
            'facebook_link'    => $pressRelease->getNewsroom()->getFacebookLink(),
            'slug'             => $pressRelease->getNewsroom()->getSlug(),
            'twitter_link'     => $pressRelease->getNewsroom()->getTwitterLink(),
            'google_plus_link' => $pressRelease->getNewsroom()->getGooglePlusLink(),
            'pint_rest_link'   => $pressRelease->getNewsroom()->getPinterestLink(),
            'instagram_link'   => $pressRelease->getNewsroom()->getInstagramLink(),
            'youtube_link'     => $pressRelease->getNewsroom()->getYoutubeLink(),
            'linked_in_link'   => $pressRelease->getNewsroom()->getLinkedinLink(),
            'viameo_link'      => $pressRelease->getNewsroom()->getVimeoLink(),
            'flicker_link'     => $pressRelease->getNewsroom()->getFlickrLink(),
            'tumblr_link'      => $pressRelease->getNewsroom()->getTumblrLink(),
            'title'            => $pressRelease->getNewsroom()->getName(),
            'description'      => $pressRelease->getNewsroom()->getDescription(),
            'content'          => $pressRelease->getContent(),
            'mailto'           => $pressRelease->getNewsroom()->getEmail(),
            'footer'           => 'copyright &copy; '.$pressRelease->getNewsroom()->getName(). ' '. $date->format('Y'),
            'picture_preview'  => $this->container->get('request_stack')->getCurrentRequest()->getSchemeAndHttpHost().$pressRelease->getPicturePreview(),
            'pr_link'          => 'client.publipr.fr/'.$pressRelease->getNewsroom()->getSlug().'/'.$pressRelease->getSlug()
        );

        return $values;
    }

    private function parseEmailTemplate($body, PressRelease $pressRelease)
    {
        $mappedBody = $body;
        $mappedValues = $this->prepareDataEmailTemplate($pressRelease);
        if(is_array($mappedValues)){
            foreach ($mappedValues as $key => $value){
               $mappedBody = str_replace($this->getParameter('emailTemplate.interpretor.startWith').$key.$this->getParameter('emailTemplate.interpretor.endWith'), $value, $mappedBody);
            }
        }
        return $mappedBody;
    }



}