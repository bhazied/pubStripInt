<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\Newsroom;
use ContinuousNet\PubliPrBundle\Form\NewsroomType;

use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\View\View as FOSView;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Voryx\RESTGeneratorBundle\Controller\VoryxController;

/**
 * Newsroom REST Controller
 * 
 * Manage Newsrooms 
 * 
 * PHP version 5.4.4
 * 
 * @category   Symfony 2 REST Controller
 * @package  ContinuousNet\PubliPrBundle\Controller
 * @author    Sahbi KHALFALLAH <sahbi.khalfallah@continuousnet.com>
 * @copyright  2016 CONTINUOUS NET
 * @license  CONTINUOUS NET REGULAR LICENSE
 * @version  Release: 1.0
 * @link    http://publipr.continuousnet.com/ContinuousNet/PubliPrBundle/Controller
 * @see      NewsroomRESTController
 * @since      Class available since Release 1.0
 * @deprecated Nothing
 * @access    public
 * @RouteResource("Newsroom")
 */
class NewsroomRESTController extends BaseRESTController
{
    /**
     * Get a Newsroom entity
     *
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @return Response
     *
     */
    public function getAction( Newsroom  $entity)
    {
        return $entity;
    }

    /**
     * Get all Newsroom entities.
     *
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @param ParamFetcherInterface $paramFetcher
     *
     * @return Response
     *
     * @QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing notes.")
     * @QueryParam(name="limit", requirements="\d+", default="1000", description="How many notes to return.")
     * @QueryParam(name="order_by", nullable=true, array=true, description="Order by fields. Must be an array ie. &order_by[name]=ASC&order_by[description]=DESC")
     * @QueryParam(name="filters", nullable=true, array=true, description="Filter by fields. Must be an array ie. &filters[id]=3")
     */
    public function cgetAction(ParamFetcherInterface $paramFetcher)
    {
        try {
            $offset = $paramFetcher->get('offset');
            $limit = $paramFetcher->get('limit');
            $order_by = $paramFetcher->get('order_by') ? $paramFetcher->get('order_by') : array();
            $filters = !is_null($paramFetcher->get('filters')) ? $paramFetcher->get('filters') : array();
            $data = array(
                'inlineCount' => 0,
                'results' => array()
            );
            $em = $this->getDoctrine()->getManager();
            $qb = $em->createQueryBuilder();
            $qb->from('PubliPrBundle:Newsroom', 'n_');
            $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\User', 'creator_user', \Doctrine\ORM\Query\Expr\Join::WITH, 'n_.creatorUser = creator_user.id');
            $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\User', 'modifier_user', \Doctrine\ORM\Query\Expr\Join::WITH, 'n_.modifierUser = modifier_user.id');
            $textFields = array('newsroom.name', 'newsroom.slug', 'newsroom.description', 'newsroom.url', 'newsroom.email', 'newsroom.bannerPicture', 'newsroom.css');
            foreach ($filters as $field => $value) {
                $_field = str_replace('newsroom.', 'n_.', $field);
                $key = str_replace('.', '', $field);
                if (!empty($value)) {
                   if (in_array($field, $textFields)) {
                       $qb->andWhere($qb->expr()->like($_field, $qb->expr()->literal('%' . $value . '%')));
                   } else {
                       $qb->andWhere($_field.' = :'.$key.'')->setParameter($key, $value);
                   }
                }
            }
            $qbList = clone $qb;
            $qb->select('count(n_.id)');
            $data['inlineCount'] = $qb->getQuery()->getSingleScalarResult();
            foreach ($order_by as $field => $direction) {
                $field = str_replace('newsroom.', 'n_.', $field);
                $qbList->addOrderBy($field, $direction);
            }
            $qbList->select('n_');
            $qbList->setMaxResults($limit);
            $qbList->setFirstResult($offset);
            $qbList->groupBy('n_.id');
            $results = $qbList->getQuery()->getResult();
            if ($results) {
                $data['results'] = $results;
            }
            return $data;
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Create a Newsroom entity.
     *
     * @View(statusCode=201, serializerEnableMaxDepthChecks=true)
     *
     * @param Request $request
     *
     * @return Response
     *
     */
    public function postAction(Request $request)
    {
        $entity = new Newsroom();
        $form = $this->createForm(new NewsroomType(), $entity, array('method' => $request->getMethod()));
        $this->removeExtraFields($request, $form);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setCreatorUser($this->getUser());
            $em->persist($entity);
            $em->flush();
            return $entity;
        }
        return FOSView::create(array('errors' => $form->getErrors()), Codes::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Update a Newsroom entity.
     *
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @param Request $request
     * @param $entity
     *
     * @return Response
     */
    public function putAction(Request $request,  Newsroom  $entity)
    {
        try {
            $em = $this->getDoctrine()->getManager();
            $request->setMethod('PATCH'); //Treat all PUTs as PATCH
            $form = $this->createForm(new NewsroomType(), $entity, array('method' => $request->getMethod()));
            $this->removeExtraFields($request, $form);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $entity->setModifierUser($this->getUser());
                $em->flush();
                return $entity;
            }
            return FOSView::create(array('errors' => $form->getErrors()), Codes::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Partial Update to a Newsroom entity.
     *
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @param Request $request
     * @param $entity
     *
     * @return Response
     */
    public function patchAction(Request $request,  Newsroom  $entity)
    {
        return $this->putAction($request, $entity);
    }

    /**
     * Delete a Newsroom entity.
     *
     * @View(statusCode=204)
     *
     * @param Request $request
     * @param $entity
     *
     * @return Response
     */
    public function deleteAction(Request $request,  Newsroom  $entity)
    {
        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();
            return null;
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
}
