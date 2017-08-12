<?php
namespace ContinuousNet\PubliPrBundle\EventListener;

use Devhelp\Piwik\Api\Api;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Devhelp\Piwik\Api\Client\PiwikClient;
use Devhelp\Piwik\Api\Guzzle\Client\PiwikGuzzleClient;
use Symfony\Component\HttpFoundation\Response;

class NewsRoomListener
{
    private $container;
    public function  __construct(ContainerInterface $_container)
    {
        $this->container = $_container;
    }

    public function postPersist(LifecycleEventArgs $args) {

        $entity = $args->getEntity();
        if($entity instanceof \ContinuousNet\PubliPrBundle\Entity\Newsroom){
            if($this->checkUserpayment($args->getEntityManager())){
                $newsRoomUrl = $this->container->getParameter('publipr.url_public_path.paied').'.'
                    .$this->container->get('request_stack')->getCurrentRequest()->getHttpHost() . '/' . $entity->getSlug(). '/';
        }
            else
            {
                $newsRoomUrl = $this->container->getParameter('publipr.url_public_path.free').'.'
                     .$this->container->get('request_stack')->getCurrentRequest()->getHttpHost() . '/' . $entity->getSlug(). '/';
            }
            $config = array('base_uri' => 'http://piwik.continuousnet.com/');
            $piwikClient = new PiwikGuzzleClient(new \GuzzleHttp\Client());
            $api = new Api($piwikClient, $this->container->getParameter('publipr.piwik.url'));
            $api->setDefaultParams(array(
                'token_auth' => $this->container->getParameter('publipr.piwik.token'),
                'format' => $this->container->getParameter('publipr.piwik.response_format'),
                'date' => 'today'
            ));
            $now = new \DateTime('now');
            $params = array(
                'siteName' => $entity->getname(),
                'urls' =>array($newsRoomUrl),
                'ecommerce' => '',
                'siteSearch' => '',
                'searchKeywordParameters' => '',
                'searchCategoryParameters' => '',
                'excludedIps' => '',
                'excludedQueryParameters' => '',
                'timezone' => '',
                'currency' => '',
                'group' => '',
                'startDate' =>'today',
                'excludedUserAgents' => '',
                 'keepURLFragments' => '',
                 'type' => '',
                 'settings' => '',
                 'excludeUnknownUrls' => ''
            );
            $allSites = $api->getMethod("SitesManager.addSite")->call($params);
            $content = json_decode($allSites->getBody()->getContents());
            $em = $args->getEntityManager();
            if(isset($content->result) && $content->result == 'error')
            {
                $em->remove($entity);
                $em->flush();
            }
            else
            {
                $entity->setPiwikReference($content->value);
                $entity->setModifierUser($this->container->get('security.context')->getToken()->getUser());
                $em->flush();
            }

        }
    }

    public function postUpdate(LifecycleEventArgs $args) {

    }

    private function checkUserpayment($em)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $paymentPlan = $em->getRepository('PubliPrBundle:PaymentPlan')->findBy(array('creatorUser' => $user->getId()));
        $payment = $em->getRepository('PubliPrBundle:Payment')->findBy(array('creatorUser' => $user->getId()));
        if(is_null($paymentPlan) && is_null($payment))
        {
            return false;
        }
        return true;
    }


}