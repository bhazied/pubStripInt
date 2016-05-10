<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Click;
use ContinuousNet\SportClubBundle\Form\ClickType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Click Controller
 * 
 * Manage Clicks 
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
 * @see		ClickController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/click")
 */
class ClickController extends BaseController
{
	/**
	 * Lists all Click entities.
	 *
	 * @Route("/", name="click_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$clicks = $em->getRepository('SportClubBundle:Click')->findAll();

		return $this->render('SportClubBundle:Click:index.html.twig', array(
			'clicks' => $clicks,
		));
	}

	/**
	 * Creates a new Click entity.
	 *
	 * @Route("/new", name="click_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$click = new Click();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\ClickType', $click);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($click);
			$em->flush();

			return $this->redirectToRoute('click_show', array('id' => $click->getId()));
		}

		return $this->render('SportClubBundle:Click:new.html.twig', array(
			'click' => $click,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Click entity.
	 *
	 * @Route("/{id}", name="click_show")
	 * @Method("GET")
	 */
	public function showAction(Click $click)
	{
		$deleteForm = $this->createDeleteForm($click);

		return $this->render('SportClubBundle:Click:show.html.twig', array(
			'click' => $click,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Click entity.
	 *
	 * @Route("/{id}/edit", name="click_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Click $click)
	{
		$deleteForm = $this->createDeleteForm($click);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\ClickType', $click);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($click);
			$em->flush();

			return $this->redirectToRoute('click_edit', array('id' => $click->getId()));
		}

		return $this->render('SportClubBundle:Click:edit.html.twig', array(
			'click' => $click,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Click entity.
	 *
	 * @Route("/{id}", name="click_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Click $click)
	{
		$form = $this->createDeleteForm($click);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($click);
			$em->flush();
		}

		return $this->redirectToRoute('click_index');
	}

	/**
	 * Creates a form to delete a Click entity.
	 *
	 * @param Click $click The Click entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Click $click)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('click_delete', array('id' => $click->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
