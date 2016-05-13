<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\TrackEmail;
use ContinuousNet\PubliPrBundle\Form\TrackEmailType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Track Email Controller
 * 
 * Manage TrackEmails 
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
 * @see		TrackEmailController
 * @since	  Class available since Release 1.0
 * @access	 public
 * @Route("/trackemail")
 */
class TrackEmailController extends BaseController
{
	/**
	 * Lists all TrackEmail entities.
	 *
	 * @Route("/", name="trackemail_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$trackEmails = $em->getRepository('PubliPrBundle:TrackEmail')->findAll();

		return $this->render('PubliPrBundle:TrackEmail:index.html.twig', array(
			'trackEmails' => $trackEmails,
		));
	}

	/**
	 * Creates a new TrackEmail entity.
	 *
	 * @Route("/new", name="trackemail_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$trackEmail = new TrackEmail();
		$form = $this->createForm('ContinuousNet\PubliPrBundle\Form\TrackEmailType', $trackEmail);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($trackEmail);
			$em->flush();

			return $this->redirectToRoute('trackemail_show', array('id' => $trackEmail->getId()));
		}

		return $this->render('PubliPrBundle:TrackEmail:new.html.twig', array(
			'trackEmail' => $trackEmail,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a TrackEmail entity.
	 *
	 * @Route("/{id}", name="trackemail_show")
	 * @Method("GET")
	 */
	public function showAction(TrackEmail $trackEmail)
	{
		$deleteForm = $this->createDeleteForm($trackEmail);

		return $this->render('PubliPrBundle:TrackEmail:show.html.twig', array(
			'trackEmail' => $trackEmail,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing TrackEmail entity.
	 *
	 * @Route("/{id}/edit", name="trackemail_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, TrackEmail $trackEmail)
	{
		$deleteForm = $this->createDeleteForm($trackEmail);
		$editForm = $this->createForm('ContinuousNet\PubliPrBundle\Form\TrackEmailType', $trackEmail);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($trackEmail);
			$em->flush();

			return $this->redirectToRoute('trackemail_edit', array('id' => $trackEmail->getId()));
		}

		return $this->render('PubliPrBundle:TrackEmail:edit.html.twig', array(
			'trackEmail' => $trackEmail,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a TrackEmail entity.
	 *
	 * @Route("/{id}", name="trackemail_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, TrackEmail $trackEmail)
	{
		$form = $this->createDeleteForm($trackEmail);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($trackEmail);
			$em->flush();
		}

		return $this->redirectToRoute('trackemail_index');
	}

	/**
	 * Creates a form to delete a TrackEmail entity.
	 *
	 * @param TrackEmail $trackEmail The TrackEmail entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(TrackEmail $trackEmail)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('trackemail_delete', array('id' => $trackEmail->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
