<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\Newsroom;
use ContinuousNet\PubliPrBundle\Form\NewsroomType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Newsroom Controller
 * 
 * Manage Newsrooms 
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
 * @see		NewsroomController
 * @since	  Class available since Release 1.0
 * @access	 public
 * @Route("/newsroom")
 */
class NewsroomController extends BaseController
{
	/**
	 * Lists all Newsroom entities.
	 *
	 * @Route("/", name="newsroom_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$newsrooms = $em->getRepository('PubliPrBundle:Newsroom')->findAll();

		return $this->render('PubliPrBundle:Newsroom:index.html.twig', array(
			'newsrooms' => $newsrooms,
		));
	}

	/**
	 * Creates a new Newsroom entity.
	 *
	 * @Route("/new", name="newsroom_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$newsroom = new Newsroom();
		$form = $this->createForm('ContinuousNet\PubliPrBundle\Form\NewsroomType', $newsroom);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($newsroom);
			$em->flush();

			return $this->redirectToRoute('newsroom_show', array('id' => $newsroom->getId()));
		}

		return $this->render('PubliPrBundle:Newsroom:new.html.twig', array(
			'newsroom' => $newsroom,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Newsroom entity.
	 *
	 * @Route("/{id}", name="newsroom_show")
	 * @Method("GET")
	 */
	public function showAction(Newsroom $newsroom)
	{
		$deleteForm = $this->createDeleteForm($newsroom);

		return $this->render('PubliPrBundle:Newsroom:show.html.twig', array(
			'newsroom' => $newsroom,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Newsroom entity.
	 *
	 * @Route("/{id}/edit", name="newsroom_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Newsroom $newsroom)
	{
		$deleteForm = $this->createDeleteForm($newsroom);
		$editForm = $this->createForm('ContinuousNet\PubliPrBundle\Form\NewsroomType', $newsroom);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($newsroom);
			$em->flush();

			return $this->redirectToRoute('newsroom_edit', array('id' => $newsroom->getId()));
		}

		return $this->render('PubliPrBundle:Newsroom:edit.html.twig', array(
			'newsroom' => $newsroom,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Newsroom entity.
	 *
	 * @Route("/{id}", name="newsroom_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Newsroom $newsroom)
	{
		$form = $this->createDeleteForm($newsroom);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($newsroom);
			$em->flush();
		}

		return $this->redirectToRoute('newsroom_index');
	}

	/**
	 * Creates a form to delete a Newsroom entity.
	 *
	 * @param Newsroom $newsroom The Newsroom entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Newsroom $newsroom)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('newsroom_delete', array('id' => $newsroom->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
