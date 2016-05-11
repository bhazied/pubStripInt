<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Show;
use ContinuousNet\SportClubBundle\Form\ShowType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Show Controller
 * 
 * Manage Shows 
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
 * @see		ShowController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/show")
 */
class ShowController extends BaseController
{
	/**
	 * Lists all Show entities.
	 *
	 * @Route("/", name="show_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$shows = $em->getRepository('SportClubBundle:Show')->findAll();

		return $this->render('SportClubBundle:Show:index.html.twig', array(
			'shows' => $shows,
		));
	}

	/**
	 * Creates a new Show entity.
	 *
	 * @Route("/new", name="show_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$show = new Show();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\ShowType', $show);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($show);
			$em->flush();

			return $this->redirectToRoute('show_show', array('id' => $show->getId()));
		}

		return $this->render('SportClubBundle:Show:new.html.twig', array(
			'show' => $show,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Show entity.
	 *
	 * @Route("/{id}", name="show_show")
	 * @Method("GET")
	 */
	public function showAction(Show $show)
	{
		$deleteForm = $this->createDeleteForm($show);

		return $this->render('SportClubBundle:Show:show.html.twig', array(
			'show' => $show,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Show entity.
	 *
	 * @Route("/{id}/edit", name="show_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Show $show)
	{
		$deleteForm = $this->createDeleteForm($show);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\ShowType', $show);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($show);
			$em->flush();

			return $this->redirectToRoute('show_edit', array('id' => $show->getId()));
		}

		return $this->render('SportClubBundle:Show:edit.html.twig', array(
			'show' => $show,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Show entity.
	 *
	 * @Route("/{id}", name="show_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Show $show)
	{
		$form = $this->createDeleteForm($show);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($show);
			$em->flush();
		}

		return $this->redirectToRoute('show_index');
	}

	/**
	 * Creates a form to delete a Show entity.
	 *
	 * @param Show $show The Show entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Show $show)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('show_delete', array('id' => $show->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
