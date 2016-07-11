<?php

namespace ContinuousNet\PubliPrBundle\Controller;
use ContinuousNet\PubliPrBundle\Entity\Contact;
use ContinuousNet\PubliPrBundle\Entity\Email;
use ContinuousNet\PubliPrBundle\Entity\EmailCampaign;
use ContinuousNet\PubliPrBundle\Entity\Newsroom;
use ContinuousNet\PubliPrBundle\Entity\Payment;
use ContinuousNet\PubliPrBundle\Entity\PaymentPlan;
use ContinuousNet\PubliPrBundle\Entity\PressRelease;

use ContinuousNet\PubliPrBundle\Entity\Product;
use ContinuousNet\PubliPrBundle\Entity\UserPaymentPlan;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Symfony\Component\Config\Definition\Exception\Exception;
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
use Symfony\Component\Routing\Route;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
use Doctrine\ORM\Query\Expr;
use Devhelp\Piwik\Api\Api;
use Devhelp\Piwik\Api\Guzzle\Client\PiwikGuzzleClient;

/**
 * Class SubscriptionApiController
 */
class DashboardRestController extends FOSRestController
{
    /**
     * @GET("/progressPr")
     * @param $request
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function progressPrAction(Request $request)
    {
        try
        {
            $data = array(
                'results' => array()
            );
            $em = $this->getDoctrine()->getManager();
            $qb = $em->createQueryBuilder();
            $qb->from('PubliPrBundle:PressRelease', 'pr_');
            $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\User', 'creatorUser', Join::WITH , 'pr_.creatorUser = creatorUser.id');
            $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\User', 'modifierUser', Join::WITH , 'pr_.modifierUser = modifierUser.id');
            $qb->where('pr_.creatorUser = :userId')->setParameter('userId', $this->getUser()->getId());
            $qb->orWhere('pr_.modifierUser = :userId')->setParameter('userId', $this->getUser()->getId());
            $qb->select('pr_');
            $qb->setMaxResults(3);
            $result = $qb->getQuery()->getResult();
            if(!is_null($result))
            {
                $data['results'] = $result;
            }
            return $data;
        }
        catch (\Exception $e)
        {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @GET("/lastPpr")
     * @param $request
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function loadLastPprAction(Request $request)
    {
        try
        {
            $data = array(
                'results' => array()
            );
            $em = $this->getDoctrine()->getManager();
            $qb = $em->createQueryBuilder();
            $qb->from('PubliPrBundle:PressRelease', 'pr_');
            $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\User', 'creatorUser', Join::WITH , 'pr_.creatorUser = creatorUser.id');
            $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\User', 'modifierUser', Join::WITH , 'pr_.modifierUser = modifierUser.id');
            $qb->where('pr_.creatorUser = :userId')->setParameter('userId', $this->getUser()->getId());
            $qb->orWhere('pr_.modifierUser = :userId')->setParameter('userId', $this->getUser()->getId());
            $qb->andWhere('pr_.status = :status')->setParameter('status', 'Online');
            $qb->select('pr_');
            $qb->setMaxResults(3);
            $result = $qb->getQuery()->getResult();
            if(!is_null($result))
            {
                $data['results'] = $result;
            }
            return $data;
        }
        catch(\Exception $e)
        {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @GET("/loadEmails/{periode}")
     * @param $request
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function loadEmailsAction(Request $request, $periode = null)
    {
        try
        {
            $tags = array();
            $emailStat= array(
                'sent' => 0,
                'rejects' => 0,
                'opens' => 0,
                'clicks' => 0
            );
            $apiKey = $this->getParameter('hip_mandrill.api_key');
            $mandrill = new \Mandrill($apiKey);
            $em = $this->getDoctrine()->getManager();
            $qb = $em->createQueryBuilder();
            $qb->from('PubliPrBundle:Email', 'e_');
            $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\PressRelease', 'pressrelease', \Doctrine\ORM\Query\Expr\Join::WITH , 'e_.pressRelease = pressrelease.id');
            $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\User', 'creatorUser', \Doctrine\ORM\Query\Expr\Join::WITH , 'e_.creatorUser = creatorUser.id');
            $qb->where('e_.creatorUser = :user')->setParameter('user', $this->getUser()->getId());
            $qb->select('e_');
            $qb->groupBy('e_.pressRelease');
            $emailspr = $qb->getQuery()->getResult();
            $emails = null;
            foreach ($emailspr as $email)
            {
                $result = $mandrill->tags->info($email->getPressRelease()->getSlug());
                if($periode != "all")
                {
                    $result = $result['stats'][$request->request->get('periode')];
                }
                $emailStat['sent'] += $result['sent'];
                $emailStat['rejects'] += $result['rejects'];
                $emailStat['opens'] += $result['opens'];
                $emailStat['clicks'] += $result['clicks'];
            }
            /*$now = new \DateTime('now');
            $end_date = $now->format('Y-m-d');
            $start_date =  $now->sub(new \DateInterval('P3M'))->format('Y-m-d');
            $result = $mandrill->messages->search("*", $start_date,$end_date,$tags, array(), array($apiKey), 1000);*/

            return $emailStat;
        }
        catch (\Exception $e)
        {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @GET("/loadVisits/{periode}")
     * @param $request
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function loadVisitsAction(Request $request, $periode)
    {
        try
        {
            $data = array(
                'newsroom' => array()
            );
            $em = $this->getDoctrine()->getManager();
            $newsRooms = $em->getRepository('PubliPrBundle:Newsroom')->findBy(array('creatorUser' => $this->getUser()->getId()));
            if(!is_null($newsRooms))
            {
                $piwikClient = new PiwikGuzzleClient(new \GuzzleHttp\Client());
                $api = new Api($piwikClient, $this->getParameter('publipr.piwik.url'));
                $api->setDefaultParams(array(
                    'token_auth' => $this->getParameter('publipr.piwik.token'),
                    'format' => $this->getParameter('publipr.piwik.response_format'),
                    'date' => 'today'
                ));
                $now = new \DateTime('now');
                $params = array(
                    'period' => 'day',
                    'date' => 'today'
                );
                foreach ($newsRooms as $nr)
                {
                    if(!is_null($nr->getPiwikReference()))
                    {
                        $params['idSite'] = $nr->getPiwikreference();
                        $result = $api->getMethod('Actions.get')->call( $params );
                        $data['newsroom'] = array(
                            'name' => $nr->getName,
                            'stats' => $result->getBody()->getContents()
                        );
                    }
                }
            }
            return $newsRooms;
        }
        catch(\Exception $e)
        {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


}