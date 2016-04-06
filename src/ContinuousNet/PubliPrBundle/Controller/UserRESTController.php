<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\User;
use ContinuousNet\PubliPrBundle\Form\UserType;

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
 * User REST Controller
 * 
 * Manage Users 
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
 * @see      UserRESTController
 * @since      Class available since Release 1.0
 * @deprecated Nothing
 * @access    public
 * @RouteResource("User")
 */
class UserRESTController extends BaseRESTController
{
    /**
     * Get a User entity
     *
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @return Response
     *
     */
    public function getAction( User  $entity)
    {
        return $entity;
    }

    /**
     * Get all User entities.
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
            $qb->from('PubliPrBundle:User', 'u_');
            $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\Company', 'company', \Doctrine\ORM\Query\Expr\Join::WITH, 'u_.company = company.id');
            $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\Country', 'country', \Doctrine\ORM\Query\Expr\Join::WITH, 'u_.country = country.id');
            $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\Language', 'language', \Doctrine\ORM\Query\Expr\Join::WITH, 'u_.language = language.id');
            $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\User', 'creator_user', \Doctrine\ORM\Query\Expr\Join::WITH, 'u_.creatorUser = creator_user.id');
            $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\User', 'modifier_user', \Doctrine\ORM\Query\Expr\Join::WITH, 'u_.modifierUser = modifier_user.id');
            $textFields = array('user.username', 'user.phone', 'user.email', 'user.usernameCanonical', 'user.emailCanonical', 'user.name', 'user.firstName', 'user.lastName', 'user.picture', 'user.address', 'user.zipCode', 'user.job', 'user.city', 'user.phoneValidationCode', 'user.emailValidationCode', 'user.roles', 'user.confirmationToken');
            foreach ($filters as $field => $value) {
                $_field = str_replace('user.', 'u_.', $field);
                $key = str_replace('.', '', $field);
                if (!empty($value)) {
                   if (in_array($field, $textFields)) {
                       $qb->andWhere($qb->expr()->like($_field, $qb->expr()->literal('%' . $value . '%')));
                   } else {
                       $qb->andWhere($_field.' = :'.$key.'')->setParameter($key, $value);
                   }
                }
            }
            $roles = $this->getUser()->getRoles();
            if (!empty($roles)) {
                foreach ($roles as $role) {
                   if (substr_count($role, 'MAN') > 0) {
                       $qb->andWhere('u_.creatorUser = :user')->setParameter('user', $this->getUser()->getId());
                   }
                }
            }
            $qbList = clone $qb;
            $qb->select('count(u_.id)');
            $data['inlineCount'] = $qb->getQuery()->getSingleScalarResult();
            foreach ($order_by as $field => $direction) {
                $field = str_replace('user.', 'u_.', $field);
                $qbList->addOrderBy($field, $direction);
            }
            $qbList->select('u_');
            $qbList->setMaxResults($limit);
            $qbList->setFirstResult($offset);
            $qbList->groupBy('u_.id');
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
     * Create a User entity.
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
        $entity = new User();
        $form = $this->createForm(new UserType(), $entity, array('method' => $request->getMethod()));
        $this->removeExtraFields($request, $form);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setCreatorUser($this->getUser());
            $authorized = false;
            $roles = $this->getUser()->getRoles();
            if (!empty($roles)) {
                foreach ($roles as $role) {
                    if (substr_count($role, 'SYSTEM') > 0) {
                        $authorized = true;
                    }
                }
            }
            if (!$authorized) {
                $entity->setPassword(null);
            }
            $authorized = false;
            $roles = $this->getUser()->getRoles();
            if (!empty($roles)) {
                foreach ($roles as $role) {
                    if (substr_count($role, 'SYSTEM') > 0) {
                        $authorized = true;
                    }
                }
            }
            if (!$authorized) {
                $entity->setSalt(null);
            }
            $authorized = false;
            $roles = $this->getUser()->getRoles();
            if (!empty($roles)) {
                foreach ($roles as $role) {
                    if (substr_count($role, 'ROLE_SUPER_ADMIN') > 0) {
                        $authorized = true;
                    }
                }
            }
            if (!$authorized) {
                $entity->setEnabled(null);
            }
            $authorized = false;
            $roles = $this->getUser()->getRoles();
            if (!empty($roles)) {
                foreach ($roles as $role) {
                    if (substr_count($role, 'SYSTEM') > 0) {
                        $authorized = true;
                    }
                }
            }
            if (!$authorized) {
                $entity->setConfirmationToken(null);
            }
            $authorized = false;
            $roles = $this->getUser()->getRoles();
            if (!empty($roles)) {
                foreach ($roles as $role) {
                    if (substr_count($role, 'SYSTEM') > 0) {
                        $authorized = true;
                    }
                }
            }
            if (!$authorized) {
                $entity->setPasswordRequestedAt(null);
            }
            $authorized = false;
            $roles = $this->getUser()->getRoles();
            if (!empty($roles)) {
                foreach ($roles as $role) {
                    if (substr_count($role, 'SYSTEM') > 0) {
                        $authorized = true;
                    }
                }
            }
            if (!$authorized) {
                $entity->setLocked(null);
            }
            $authorized = false;
            $roles = $this->getUser()->getRoles();
            if (!empty($roles)) {
                foreach ($roles as $role) {
                    if (substr_count($role, 'SYSTEM') > 0) {
                        $authorized = true;
                    }
                }
            }
            if (!$authorized) {
                $entity->setExpired(null);
            }
            $authorized = false;
            $roles = $this->getUser()->getRoles();
            if (!empty($roles)) {
                foreach ($roles as $role) {
                    if (substr_count($role, 'SYSTEM') > 0) {
                        $authorized = true;
                    }
                }
            }
            if (!$authorized) {
                $entity->setExpiresAt(null);
            }
            $authorized = false;
            $roles = $this->getUser()->getRoles();
            if (!empty($roles)) {
                foreach ($roles as $role) {
                    if (substr_count($role, 'SYSTEM') > 0) {
                        $authorized = true;
                    }
                }
            }
            if (!$authorized) {
                $entity->setCredentialsExpired(null);
            }
            $authorized = false;
            $roles = $this->getUser()->getRoles();
            if (!empty($roles)) {
                foreach ($roles as $role) {
                    if (substr_count($role, 'SYSTEM') > 0) {
                        $authorized = true;
                    }
                }
            }
            if (!$authorized) {
                $entity->setCredentialsExpireAt(null);
            }
            $authorized = false;
            $roles = $this->getUser()->getRoles();
            if (!empty($roles)) {
                foreach ($roles as $role) {
                    if (substr_count($role, 'SYSTEM') > 0) {
                        $authorized = true;
                    }
                }
            }
            if (!$authorized) {
                $entity->setLastLogin(null);
            }
            $authorized = false;
            $roles = $this->getUser()->getRoles();
            if (!empty($roles)) {
                foreach ($roles as $role) {
                    if (substr_count($role, 'SYSTEM') > 0) {
                        $authorized = true;
                    }
                }
            }
            if (!$authorized) {
                $entity->setLastFailedLogin(null);
            }
            $authorized = false;
            $roles = $this->getUser()->getRoles();
            if (!empty($roles)) {
                foreach ($roles as $role) {
                    if (substr_count($role, 'SYSTEM') > 0) {
                        $authorized = true;
                    }
                }
            }
            if (!$authorized) {
                $entity->setLoginCount(null);
            }
            $authorized = false;
            $roles = $this->getUser()->getRoles();
            if (!empty($roles)) {
                foreach ($roles as $role) {
                    if (substr_count($role, 'SYSTEM') > 0) {
                        $authorized = true;
                    }
                }
            }
            if (!$authorized) {
                $entity->setFailedLoginCount(null);
            }
            $authorized = false;
            $roles = $this->getUser()->getRoles();
            if (!empty($roles)) {
                foreach ($roles as $role) {
                    if (substr_count($role, 'SYSTEM') > 0) {
                        $authorized = true;
                    }
                }
            }
            if (!$authorized) {
                $entity->setLastFailedLoginCount(null);
            }
            $em->persist($entity);
            $em->flush();
            return $entity;
        }
        return FOSView::create(array('errors' => $form->getErrors()), Codes::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Update a User entity.
     *
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @param Request $request
     * @param $entity
     *
     * @return Response
     */
    public function putAction(Request $request,  User  $entity)
    {
        try {
            $em = $this->getDoctrine()->getManager();
            $request->setMethod('PATCH'); //Treat all PUTs as PATCH
            $entity->setRoles(array());
            $form = $this->createForm(new UserType(), $entity, array('method' => $request->getMethod()));
            $this->removeExtraFields($request, $form);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $entity->setModifierUser($this->getUser());
                $authorized = false;
                $roles = $this->getUser()->getRoles();
                if (!empty($roles)) {
                    foreach ($roles as $role) {
                        if (substr_count($role, 'SYSTEM') > 0) {
                            $authorized = true;
                        }
                    }
                }
                if (!$authorized) {
                    $entity->setPassword(null);
                }
                $authorized = false;
                $roles = $this->getUser()->getRoles();
                if (!empty($roles)) {
                    foreach ($roles as $role) {
                        if (substr_count($role, 'SYSTEM') > 0) {
                            $authorized = true;
                        }
                    }
                }
                if (!$authorized) {
                    $entity->setSalt(null);
                }
                $authorized = false;
                $roles = $this->getUser()->getRoles();
                if (!empty($roles)) {
                    foreach ($roles as $role) {
                        if (substr_count($role, 'ROLE_SUPER_ADMIN') > 0) {
                            $authorized = true;
                        }
                    }
                }
                if (!$authorized) {
                    $entity->setEnabled(null);
                }
                $authorized = false;
                $roles = $this->getUser()->getRoles();
                if (!empty($roles)) {
                    foreach ($roles as $role) {
                        if (substr_count($role, 'SYSTEM') > 0) {
                            $authorized = true;
                        }
                    }
                }
                if (!$authorized) {
                    $entity->setConfirmationToken(null);
                }
                $authorized = false;
                $roles = $this->getUser()->getRoles();
                if (!empty($roles)) {
                    foreach ($roles as $role) {
                        if (substr_count($role, 'SYSTEM') > 0) {
                            $authorized = true;
                        }
                    }
                }
                if (!$authorized) {
                    $entity->setPasswordRequestedAt(null);
                }
                $authorized = false;
                $roles = $this->getUser()->getRoles();
                if (!empty($roles)) {
                    foreach ($roles as $role) {
                        if (substr_count($role, 'SYSTEM') > 0) {
                            $authorized = true;
                        }
                    }
                }
                if (!$authorized) {
                    $entity->setLocked(null);
                }
                $authorized = false;
                $roles = $this->getUser()->getRoles();
                if (!empty($roles)) {
                    foreach ($roles as $role) {
                        if (substr_count($role, 'SYSTEM') > 0) {
                            $authorized = true;
                        }
                    }
                }
                if (!$authorized) {
                    $entity->setExpired(null);
                }
                $authorized = false;
                $roles = $this->getUser()->getRoles();
                if (!empty($roles)) {
                    foreach ($roles as $role) {
                        if (substr_count($role, 'SYSTEM') > 0) {
                            $authorized = true;
                        }
                    }
                }
                if (!$authorized) {
                    $entity->setExpiresAt(null);
                }
                $authorized = false;
                $roles = $this->getUser()->getRoles();
                if (!empty($roles)) {
                    foreach ($roles as $role) {
                        if (substr_count($role, 'SYSTEM') > 0) {
                            $authorized = true;
                        }
                    }
                }
                if (!$authorized) {
                    $entity->setCredentialsExpired(null);
                }
                $authorized = false;
                $roles = $this->getUser()->getRoles();
                if (!empty($roles)) {
                    foreach ($roles as $role) {
                        if (substr_count($role, 'SYSTEM') > 0) {
                            $authorized = true;
                        }
                    }
                }
                if (!$authorized) {
                    $entity->setCredentialsExpireAt(null);
                }
                $authorized = false;
                $roles = $this->getUser()->getRoles();
                if (!empty($roles)) {
                    foreach ($roles as $role) {
                        if (substr_count($role, 'SYSTEM') > 0) {
                            $authorized = true;
                        }
                    }
                }
                if (!$authorized) {
                    $entity->setLastLogin(null);
                }
                $authorized = false;
                $roles = $this->getUser()->getRoles();
                if (!empty($roles)) {
                    foreach ($roles as $role) {
                        if (substr_count($role, 'SYSTEM') > 0) {
                            $authorized = true;
                        }
                    }
                }
                if (!$authorized) {
                    $entity->setLastFailedLogin(null);
                }
                $authorized = false;
                $roles = $this->getUser()->getRoles();
                if (!empty($roles)) {
                    foreach ($roles as $role) {
                        if (substr_count($role, 'SYSTEM') > 0) {
                            $authorized = true;
                        }
                    }
                }
                if (!$authorized) {
                    $entity->setLoginCount(null);
                }
                $authorized = false;
                $roles = $this->getUser()->getRoles();
                if (!empty($roles)) {
                    foreach ($roles as $role) {
                        if (substr_count($role, 'SYSTEM') > 0) {
                            $authorized = true;
                        }
                    }
                }
                if (!$authorized) {
                    $entity->setFailedLoginCount(null);
                }
                $authorized = false;
                $roles = $this->getUser()->getRoles();
                if (!empty($roles)) {
                    foreach ($roles as $role) {
                        if (substr_count($role, 'SYSTEM') > 0) {
                            $authorized = true;
                        }
                    }
                }
                if (!$authorized) {
                    $entity->setLastFailedLoginCount(null);
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
     * Partial Update to a User entity.
     *
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @param Request $request
     * @param $entity
     *
     * @return Response
     */
    public function patchAction(Request $request,  User  $entity)
    {
        return $this->putAction($request, $entity);
    }

    /**
     * Delete a User entity.
     *
     * @View(statusCode=204)
     *
     * @param Request $request
     * @param $entity
     *
     * @return Response
     */
    public function deleteAction(Request $request,  User  $entity)
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
