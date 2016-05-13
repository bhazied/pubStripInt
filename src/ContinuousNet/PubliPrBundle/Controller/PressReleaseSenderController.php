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

class PressReleaseSenderController extends FOSRestController
{
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
        $emailTemplate = $this->getEmailTemplate($one->getSlug(), $em);
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
            ->setHtml($this->parseEmailTemplate($emailTemplate->getBody(), $one->getNewsroom()))
            ->setFromEmail($emailTemplate->getFromEmail())
            ->setReplyTo($emailTemplate->getReplyToEmail());
        foreach ($contacts as $contact) {
            $message->addTo($contact->getEmail(), $contact->getFirstName() . ' ' . $contact->getLastName());
        }
        $result = $dispatcher->send($message);
        foreach($contacts as $contact)
        {
            $keyResult = array_search($contact->getEmail(), array_column($result, 'email'));
            $this->saveEmailsContact($one, $contact, $result[$keyResult]['status'], $em);
        }
        $this->saveEmailCampaign($one, $em);
        $em->flush();
        return true;
    }

    /**
     * @Get("/PrStat")
     * @param $request
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function StatisticAction(Request $request)
    {
        return null;
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
        $email->setSendingStatus($sendingStatus);
        $em->persist($email);
        return $email;
        
    }

    private function saveEmailCampaign(PressRelease $pressRelease, EntityManager $em)
    {
        $emailCampaign = new EmailCampaign();
        $emailCampaign->setPressRelease($pressRelease);
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

    private function prepareDataEmailTemplate(Newsroom $newsroom)
    {
        $values = array(
            'facebook_link'    => $newsroom->getFacebookLink(),
            //'slug'             => $newsroom->getSlug(),
            'twitter_link'     => $newsroom->getTwitterLink(),
            'google_plus_link' => $newsroom->getGooglePlusLink(),
            'pint_rest_link'   => $newsroom->getPinterestLink(),
            'instagram_link'   => $newsroom->getInstagramLink(),
            'youtube_link'     => $newsroom->getYoutubeLink(),
            'linked_in_link'   => $newsroom->getLinkedinLink(),
            'viameo_link'      => $newsroom->getVimeoLink(),
            'flicker_link'      => $newsroom->getFlickrLink(),
            'tumblr_link'      => $newsroom->getTumblrLink(),
        );

        return $values;
    }

    private function parseEmailTemplate($body, Newsroom $newsroom)
    {
        $mappedBody = $body;
        $mappedValues = $this->prepareDataEmailTemplate($newsroom);
        if(is_array($mappedValues)){
            foreach ($mappedValues as $key => $value){
               $mappedBody = str_replace($this->getParameter('emailTemplate.interpretor.startWith').$key.$this->getParameter('emailTemplate.interpretor.endWith'), $value, $mappedBody);
            }
        }
        return $mappedBody;
    }



}