<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\NewsroomsUsers;
use ContinuousNet\PubliPrBundle\Form\NewsroomsUsersType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Newsrooms Users Controller
 * 
 * Manage NewsroomsUsers 
 * 
 * PHP version 5.4.4
 * 
 * @category   Symfony 2 Controller
 * @package	ContinuousNet\PubliPrBundle\Controller
 * @author	 Sahbi KHALFALLAH <sahbi.khalfallah@continuousnet.com>
 * @copyright  2016 CONTINUOUS NET
 * @license	CONTINUOUS NET REGULAR LICENSE
 * @version	Release: 1.0
 * @link	   http://publipr.continuousnet.com/ContinuousNet/PubliPrBundle/Controller
 * @see		NewsroomsUsersController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/newsroomsusers")
 */
class NewsroomsUsersController extends BaseController
{
	/**
	 * Lists all NewsroomsUsers entities.
	 *
	 * @Route("/", name="newsroomsusers_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$newsroomsUsers = $em->getRepository('PubliPrBundle:NewsroomsUsers')->findAll();

		return $this->render('PubliPrBundle:NewsroomsUsers:index.html.twig', array(
			'newsroomsUsers' => $newsroomsUsers,
		));
	}

	/**
	 * Creates a new NewsroomsUsers entity.
	 *
	 * @Route("/new", name="newsroomsusers_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$newsroomsUsers = new NewsroomsUsers();
		$form = $this->createForm('ContinuousNet\PubliPrBundle\Form\NewsroomsUsersType', $newsroomsUsers);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($newsroomsUsers);
			$em->flush();

			return $this->redirectToRoute('newsroomsusers_show', array('id' => $newsroomsUsers->getId()));
		}

		return $this->render('PubliPrBundle:NewsroomsUsers:new.html.twig', array(
			'newsroomsUsers' => $newsroomsUsers,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a NewsroomsUsers entity.
	 *
	 * @Route("/{id}", name="newsroomsusers_show")
	 * @Method("GET")
	 */
	public function showAction(NewsroomsUsers $newsroomsUsers)
	{
		$deleteForm = $this->createDeleteForm($newsroomsUsers);

		return $this->render('PubliPrBundle:NewsroomsUsers:show.html.twig', array(
			'newsroomsUsers' => $newsroomsUsers,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing NewsroomsUsers entity.
	 *
	 * @Route("/{id}/edit", name="newsroomsusers_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, NewsroomsUsers $newsroomsUsers)
	{
		$deleteForm = $this->createDeleteForm($newsroomsUsers);
		$editForm = $this->createForm('ContinuousNet\PubliPrBundle\Form\NewsroomsUsersType', $newsroomsUsers);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($newsroomsUsers);
			$em->flush();

			return $this->redirectToRoute('newsroomsusers_edit', array('id' => $newsroomsUsers->getId()));
		}

		return $this->render('PubliPrBundle:NewsroomsUsers:edit.html.twig', array(
			'newsroomsUsers' => $newsroomsUsers,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a NewsroomsUsers entity.
	 *
	 * @Route("/{id}", name="newsroomsusers_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, NewsroomsUsers $newsroomsUsers)
	{
		$form = $this->createDeleteForm($newsroomsUsers);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($newsroomsUsers);
			$em->flush();
		}

		return $this->redirectToRoute('newsroomsusers_index');
	}

	/**
	 * Creates a form to delete a NewsroomsUsers entity.
	 *
	 * @param NewsroomsUsers $newsroomsUsers The NewsroomsUsers entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(NewsroomsUsers $newsroomsUsers)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('newsroomsusers_delete', array('id' => $newsroomsUsers->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
