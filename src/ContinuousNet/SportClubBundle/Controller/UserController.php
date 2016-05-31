<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\User;
use ContinuousNet\SportClubBundle\Form\UserType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * User Controller
 * 
 * Manage Users 
 * 
 * PHP version 5.4.4
 * 
 * @category   Symfony 2 Controller
 * @package	ContinuousNet\SportClubBundle\Controller
 * @author	 Sahbi KHALFALLAH <sahbi.khalfallah@continuousnet.com>
 * @copyright  2016 CONTINUOUS NET
 * @license	CONTINUOUS NET REGULAR LICENSE
 * @version	Release: 1.0
 * @link	   http://sportclub.continuousnet.com/ContinuousNet/SportClubBundle/Controller
 * @see		UserController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/user")
 */
class UserController extends BaseController
{
	/**
	 * Lists all User entities.
	 *
	 * @Route("/", name="user_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$users = $em->getRepository('SportClubBundle:User')->findAll();

		return $this->render('SportClubBundle:User:index.html.twig', array(
			'users' => $users,
		));
	}

	/**
	 * Creates a new User entity.
	 *
	 * @Route("/new", name="user_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$user = new User();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\UserType', $user);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($user);
			$em->flush();

			return $this->redirectToRoute('user_show', array('id' => $user->getId()));
		}

		return $this->render('SportClubBundle:User:new.html.twig', array(
			'user' => $user,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a User entity.
	 *
	 * @Route("/{id}", name="user_show")
	 * @Method("GET")
	 */
	public function showAction(User $user)
	{
		$deleteForm = $this->createDeleteForm($user);

		return $this->render('SportClubBundle:User:show.html.twig', array(
			'user' => $user,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing User entity.
	 *
	 * @Route("/{id}/edit", name="user_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, User $user)
	{
		$deleteForm = $this->createDeleteForm($user);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\UserType', $user);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($user);
			$em->flush();

			return $this->redirectToRoute('user_edit', array('id' => $user->getId()));
		}

		return $this->render('SportClubBundle:User:edit.html.twig', array(
			'user' => $user,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a User entity.
	 *
	 * @Route("/{id}", name="user_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, User $user)
	{
		$form = $this->createDeleteForm($user);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($user);
			$em->flush();
		}

		return $this->redirectToRoute('user_index');
	}

	/**
	 * Creates a form to delete a User entity.
	 *
	 * @param User $user The User entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(User $user)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
