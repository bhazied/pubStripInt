<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\Layout;
use ContinuousNet\PubliPrBundle\Form\LayoutType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Layout Controller
 * 
 * Manage Layouts 
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
 * @see		LayoutController
 * @since	  Class available since Release 1.0
 * @access	 public
 * @Route("/layout")
 */
class LayoutController extends BaseController
{
	/**
	 * Lists all Layout entities.
	 *
	 * @Route("/", name="layout_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$layouts = $em->getRepository('PubliPrBundle:Layout')->findAll();

		return $this->render('PubliPrBundle:Layout:index.html.twig', array(
			'layouts' => $layouts,
		));
	}

	/**
	 * Creates a new Layout entity.
	 *
	 * @Route("/new", name="layout_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$layout = new Layout();
		$form = $this->createForm('ContinuousNet\PubliPrBundle\Form\LayoutType', $layout);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($layout);
			$em->flush();

			return $this->redirectToRoute('layout_show', array('id' => $layout->getId()));
		}

		return $this->render('PubliPrBundle:Layout:new.html.twig', array(
			'layout' => $layout,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Layout entity.
	 *
	 * @Route("/{id}", name="layout_show")
	 * @Method("GET")
	 */
	public function showAction(Layout $layout)
	{
		$deleteForm = $this->createDeleteForm($layout);

		return $this->render('PubliPrBundle:Layout:show.html.twig', array(
			'layout' => $layout,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Layout entity.
	 *
	 * @Route("/{id}/edit", name="layout_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Layout $layout)
	{
		$deleteForm = $this->createDeleteForm($layout);
		$editForm = $this->createForm('ContinuousNet\PubliPrBundle\Form\LayoutType', $layout);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($layout);
			$em->flush();

			return $this->redirectToRoute('layout_edit', array('id' => $layout->getId()));
		}

		return $this->render('PubliPrBundle:Layout:edit.html.twig', array(
			'layout' => $layout,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Layout entity.
	 *
	 * @Route("/{id}", name="layout_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Layout $layout)
	{
		$form = $this->createDeleteForm($layout);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($layout);
			$em->flush();
		}

		return $this->redirectToRoute('layout_index');
	}

	/**
	 * Creates a form to delete a Layout entity.
	 *
	 * @param Layout $layout The Layout entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Layout $layout)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('layout_delete', array('id' => $layout->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
