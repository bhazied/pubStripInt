<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Player;
use ContinuousNet\SportClubBundle\Form\PlayerType;

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
 * Player REST Controller
 * 
 * Manage Players 
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
 * @see      PlayerRESTController
 * @since      Class available since Release 1.0
 * @deprecated Nothing
 * @access    public
 * @RouteResource("Player")
 */
class PlayerRESTController extends BaseRESTController
{
    /**
     * Get a Player entity
     *
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @return Response
     *
     */
    public function getAction( Player  $entity)
    {
        return $entity;
    }

    /**
     * Get all Player entities.
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
            $qb->from('SportClubBundle:Player', 'p_');
            $qb->leftJoin('ContinuousNet\SportClubBundle\Entity\Country', 'birth_country', \Doctrine\ORM\Query\Expr\Join::WITH, 'p_.birthCountry = birth_country.id');
            $qb->leftJoin('ContinuousNet\SportClubBundle\Entity\Country', 'nationality_country', \Doctrine\ORM\Query\Expr\Join::WITH, 'p_.nationalityCountry = nationality_country.id');
            $qb->leftJoin('ContinuousNet\SportClubBundle\Entity\Team', 'team_club', \Doctrine\ORM\Query\Expr\Join::WITH, 'p_.teamClub = team_club.id');
            $qb->leftJoin('ContinuousNet\SportClubBundle\Entity\Team', 'team_national', \Doctrine\ORM\Query\Expr\Join::WITH, 'p_.teamNational = team_national.id');
            $qb->leftJoin('ContinuousNet\SportClubBundle\Entity\User', 'creator_user', \Doctrine\ORM\Query\Expr\Join::WITH, 'p_.creatorUser = creator_user.id');
            $qb->leftJoin('ContinuousNet\SportClubBundle\Entity\User', 'modifier_user', \Doctrine\ORM\Query\Expr\Join::WITH, 'p_.modifierUser = modifier_user.id');
            $textFields = array('player.name', 'player.nameAr', 'player.nameFr', 'player.picture', 'player.firstName', 'player.firstNameAr', 'player.firstNameFr', 'player.lastName', 'player.lastNameAr', 'player.lastNameFr', 'player.birthPlace', 'player.birthPlaceAr', 'player.birthPlaceFr', 'player.wivesNames', 'player.sonsNames', 'player.daughtersNames', 'player.fatherName', 'player.motherName', 'player.brothersNames', 'player.sistersNames', 'player.education', 'player.personalAttributes', 'player.hobbies', 'player.favouriteFood', 'player.favouriteDrink', 'player.firstReplicaKit', 'player.tvShowRarelyMiss', 'player.personalBiography', 'player.technicalProfile', 'player.facebook', 'player.twitter', 'player.website', 'player.eurosport', 'player.lequipe');
            foreach ($filters as $field => $value) {
                $_field = str_replace('player.', 'p_.', $field);
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
            $qb->select('count(p_.id)');
            $data['inlineCount'] = $qb->getQuery()->getSingleScalarResult();
            foreach ($order_by as $field => $direction) {
                $field = str_replace('player.', 'p_.', $field);
                $qbList->addOrderBy($field, $direction);
            }
            $qbList->select('p_');
            $qbList->setMaxResults($limit);
            $qbList->setFirstResult($offset);
            $qbList->groupBy('p_.id');
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
     * Create a Player entity.
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
        $entity = new Player();
        $form = $this->createForm(new PlayerType(), $entity, array('method' => $request->getMethod()));
        $this->removeExtraFields($request, $form);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
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
            $em->flush();
            return $entity;
        }
    }

    /**
     * Update a Player entity.
     *
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @param Request $request
     * @param $entity
     *
     * @return Response
     */
    public function putAction(Request $request, Player $entity)
    {
        try {
            $em = $this->getDoctrine()->getManager();
            $request->setMethod('PATCH'); //Treat all PUTs as PATCH
            $form = $this->createForm(new PlayerType(), $entity, array('method' => $request->getMethod()));
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
     * Partial Update to a Player entity.
     *
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @param Request $request
     * @param $entity
     *
     * @return Response
     */
    public function patchAction(Request $request, Player $entity)
    {
        return $this->putAction($request, $entity);
    }

    /**
     * Delete a Player entity.
     *
     * @View(statusCode=204)
     *
     * @param Request $request
     * @param $entity
     *
     * @return Response
     */
    public function deleteAction(Request $request, Player $entity)
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
