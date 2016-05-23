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


class SubscriptionApiController extends FOSRestController
{
/**
 * @GET("/CheckSubscription")
 * @param $request
 * @View(serializerEnableMaxDepthChecks=true)
 */
    public function checkAction(Request $request){
        try{
            $data = array(
                'validity_periode' => '',
                'validate' => false
            );
            $currentDate = new \DateTime('now');
            $currentDate = $currentDate->format('Y-m-d H:m:s');
            $em = $this->getDoctrine()->getManager();
            $qb = $em->createQueryBuilder();
            $qb->from("PubliPrBundle:Subscription", "sub_");
            $qb->leftJoin("\ContinuousNet\PubliPrBundle\Entity\User", "user", \Doctrine\ORM\Query\Expr\Join::WITH, "sub_.user=user.id");
            $qb->andWhere("sub_.user=:user")->setParameter('user', $this->getUser()->getId());
            $qb->andwhere(":currentDate BETWEEN sub_.startDate AND sub_.endDate")->setParameter('currentDate', $currentDate);
            $qb->select('sub_');
            $result = $qb->getQuery()->getresult();
            if($result){
                $end = new \DateTime($result->getEndDate());
                $diff = $end->diff($currentDate)->days;
                $data['validity_periode'] = $diff;
                $data['validate'] = true;
            }
            return $data;
        }catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    /**
     * @GET("/Settings")
     * @param $request
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function settingsAction(Request $request)
    {
        try{
            $data= array();
            $settings = $this->get('publi_pr.settings');
            $data['default_currency'] = $settings->getSetting('DEFAULT_CURRENCY')->getValue();
            return $data;
        }catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}