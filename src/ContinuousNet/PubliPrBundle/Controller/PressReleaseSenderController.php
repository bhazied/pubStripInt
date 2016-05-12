<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\PressRelease;

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
        //$pressRelease = $em->getRepository('PubliPrBundle:PressRelease')->find($request->request->get('prId'));
        $pressRelease = $qb->getQuery()->getResult();
        $one = $pressRelease[0];

        //get list contact emails
        $contactQuery = $em->createQueryBuilder();
        $contactQuery->from('PubliPrBundle:Contact', 'ct_');
        $contactQuery->where('ct_.contactGroup IN (:groups)')->setParameter('groups', $request->request->get('cgIds'));
        $contactQuery->select('ct_');
        $contacts = $contactQuery->getQuery()->getResult();
        return $contacts;
        //return $one->getNewsroom();
    }

}