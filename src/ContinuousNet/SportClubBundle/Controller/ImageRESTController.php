<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Image;
use ContinuousNet\SportClubBundle\Form\ImageType;

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
use Symfony\Component\Finder\Finder;;
use Symfony\Component\Finder\SplFileInfo;

use Voryx\RESTGeneratorBundle\Controller\VoryxController;

/**
 * Image REST Controller
 * 
 * Manage Images 
 * 
 * PHP version 5.4.4
 * 
 * @category   Symfony 2 REST Controller
 * @package  ContinuousNet\SportClubBundle\Controller
 * @author    Sahbi KHALFALLAH <sahbi.khalfallah@continuousnet.com>
 * @copyright  2016 CONTINUOUS NET
 * @license  CONTINUOUS NET REGULAR LICENSE
 * @version  Release: 1.0
 * @link    http://sportclub.continuousnet.com/ContinuousNet/SportClubBundle/Controller
 * @see      ImageRESTController
 * @since      Class available since Release 1.0
 * @deprecated Nothing
 * @access    public
 * @RouteResource("Image")
 */
class ImageRESTController extends BaseRESTController
{
    /**
     * Get a Image entity
     *
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @return Response
     *
     */
    public function getAction( Image  $entity)
    {
        return $entity;
    }

    /**
     * Get all Image entities.
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
            $qb->from('SportClubBundle:Image', 'i_');
            $qb->leftJoin('ContinuousNet\SportClubBundle\Entity\ImageType', 'image_type', \Doctrine\ORM\Query\Expr\Join::WITH, 'i_.imageType = image_type.id');
            $qb->leftJoin('ContinuousNet\SportClubBundle\Entity\Price', 'price', \Doctrine\ORM\Query\Expr\Join::WITH, 'i_.price = price.id');
            $qb->leftJoin('ContinuousNet\SportClubBundle\Entity\Sharing', 'sharing', \Doctrine\ORM\Query\Expr\Join::WITH, 'i_.sharing = sharing.id');
            $qb->leftJoin('ContinuousNet\SportClubBundle\Entity\Gallery', 'gallery', \Doctrine\ORM\Query\Expr\Join::WITH, 'i_.gallery = gallery.id');
            $qb->leftJoin('ContinuousNet\SportClubBundle\Entity\User', 'creator_user', \Doctrine\ORM\Query\Expr\Join::WITH, 'i_.creatorUser = creator_user.id');
            $qb->leftJoin('ContinuousNet\SportClubBundle\Entity\User', 'modifier_user', \Doctrine\ORM\Query\Expr\Join::WITH, 'i_.modifierUser = modifier_user.id');
            $textFields = array('image.name', 'image.nameAr', 'image.nameFr', 'image.slug', 'image.slugAr', 'image.slugFr', 'image.picture', 'image.description', 'image.descriptionAr', 'image.descriptionFr', 'image.url', 'image.copyright', 'image.watermarkText');
            foreach ($filters as $field => $value) {
                $_field = str_replace('image.', 'i_.', $field);
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
            $qb->select('count(i_.id)');
            $data['inlineCount'] = $qb->getQuery()->getSingleScalarResult();
            foreach ($order_by as $field => $direction) {
                $field = str_replace('image.', 'i_.', $field);
                $qbList->addOrderBy($field, $direction);
            }
            $qbList->select('i_');
            $qbList->setMaxResults($limit);
            $qbList->setFirstResult($offset);
            $qbList->groupBy('i_.id');
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
     * Create a Image entity.
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
        $batch = $request->request->get('batch');
        $selectedFile = $request->request->get('picture');
        $filePath = $this->getConfig('uplopad.main_dir') . $selectedFile;
        $finder = new Finder();
        if (!is_null($batch)) {
            $finder->files()->in(dirname($filePath))->sortByName();
        } else {
            $finder->append(array($filePath));
        }
        foreach ($finder as $file) {
            $filePath = str_replace($this->getConfig('uplopad.main_dir'), '', $file->getRealpath());
            $request->request->set('picture', $filePath);
            $path_parts = pathinfo($filePath);
            $request->request->set('name', $path_parts['filename']);
            $request->request->set('slug', strtolower(str_replace(' ', '-', $path_parts['filename'])));
            $entity = new Image();
            $form = $this->createForm(new ImageType(), $entity, array('method' => $request->getMethod()));
            $this->removeExtraFields($request, $form);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                if (!$em->isOpen()) {
                   $this->getDoctrine()->resetManager();
                   $em = $this->getDoctrine()->getManager();
                }
                $entity->setCreatorUser($this->getUser());
                $authorizedChangeStatus = false;
                $roles = $this->getUser()->getRoles();
                if (!empty($roles)) {
                    foreach ($roles as $role) {
                        if (substr_count($role, 'ROLE_ADMIN_PUBLISHER') > 0) {
                            $authorizedChangeStatus = true;
                        }
                    }
                }
                if (!$authorizedChangeStatus) {
                    $entity->setStatus('Draft');
                }
                $em->persist($entity);
                    $entities[] = $entity;
            }
        }
        try {
            $em->flush();
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $entities;
    }

    /**
     * Update a Image entity.
     *
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @param Request $request
     * @param $entity
     *
     * @return Response
     */
    public function putAction(Request $request, Image $entity)
    {
        try {
            $em = $this->getDoctrine()->getManager();
            $request->setMethod('PATCH'); //Treat all PUTs as PATCH
            $previousImageCategories = $entity->getImageCategories()->toArray();
            foreach ($previousImageCategories as $previousImageCategory) {
                $entity->removeImageCategory($previousImageCategory);
            }
            $form = $this->createForm(new ImageType(), $entity, array('method' => $request->getMethod()));
            $this->removeExtraFields($request, $form);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $entity->setModifierUser($this->getUser());
                $authorizedChangeStatus = false;
                $roles = $this->getUser()->getRoles();
                if (!empty($roles)) {
                    foreach ($roles as $role) {
                        if (substr_count($role, 'ROLE_ADMIN_PUBLISHER') > 0) {
                            $authorizedChangeStatus = true;
                        }
                    }
                }
                if (!$authorizedChangeStatus) {
                    $entity->setStatus('Draft');
                }
                $em->flush();
                return $entity;
            }
            return FOSView::create(array('errors' => $form->getErrors()), Codes::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Partial Update to a Image entity.
     *
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @param Request $request
     * @param $entity
     *
     * @return Response
     */
    public function patchAction(Request $request, Image $entity)
    {
        return $this->putAction($request, $entity);
    }

    /**
     * Delete a Image entity.
     *
     * @View(statusCode=204)
     *
     * @param Request $request
     * @param $entity
     *
     * @return Response
     */
    public function deleteAction(Request $request, Image $entity)
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
    
    private function getConfig($path) {
        $config = $this->container->getParameter('sport_club');
        $paths = explode('.', $path);
        foreach ($paths as $index) {
            $config = $config[$index];
        }
        return $config;
    }

}
