<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\EmailCampaign;
use ContinuousNet\PubliPrBundle\Form\EmailCampaignType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Email Campaign Controller
 * 
 * Manage EmailCampaigns 
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
 * @see		EmailCampaignController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/emailcampaign")
 */
class EmailCampaignController extends BaseController
{
	/**
	 * Lists all EmailCampaign entities.
	 *
	 * @Route("/", name="emailcampaign_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$emailCampaigns = $em->getRepository('PubliPrBundle:EmailCampaign')->findAll();

		return $this->render('PubliPrBundle:EmailCampaign:index.html.twig', array(
			'emailCampaigns' => $emailCampaigns,
		));
	}

	/**
	 * Creates a new EmailCampaign entity.
	 *
	 * @Route("/new", name="emailcampaign_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$emailCampaign = new EmailCampaign();
		$form = $this->createForm('ContinuousNet\PubliPrBundle\Form\EmailCampaignType', $emailCampaign);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($emailCampaign);
			$em->flush();

			return $this->redirectToRoute('emailcampaign_show', array('id' => $emailCampaign->getId()));
		}

		return $this->render('PubliPrBundle:EmailCampaign:new.html.twig', array(
			'emailCampaign' => $emailCampaign,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a EmailCampaign entity.
	 *
	 * @Route("/{id}", name="emailcampaign_show")
	 * @Method("GET")
	 */
	public function showAction(EmailCampaign $emailCampaign)
	{
		$deleteForm = $this->createDeleteForm($emailCampaign);

		return $this->render('PubliPrBundle:EmailCampaign:show.html.twig', array(
			'emailCampaign' => $emailCampaign,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing EmailCampaign entity.
	 *
	 * @Route("/{id}/edit", name="emailcampaign_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, EmailCampaign $emailCampaign)
	{
		$deleteForm = $this->createDeleteForm($emailCampaign);
		$editForm = $this->createForm('ContinuousNet\PubliPrBundle\Form\EmailCampaignType', $emailCampaign);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($emailCampaign);
			$em->flush();

			return $this->redirectToRoute('emailcampaign_edit', array('id' => $emailCampaign->getId()));
		}

		return $this->render('PubliPrBundle:EmailCampaign:edit.html.twig', array(
			'emailCampaign' => $emailCampaign,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a EmailCampaign entity.
	 *
	 * @Route("/{id}", name="emailcampaign_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, EmailCampaign $emailCampaign)
	{
		$form = $this->createDeleteForm($emailCampaign);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($emailCampaign);
			$em->flush();
		}

		return $this->redirectToRoute('emailcampaign_index');
	}

	/**
	 * Creates a form to delete a EmailCampaign entity.
	 *
	 * @param EmailCampaign $emailCampaign The EmailCampaign entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(EmailCampaign $emailCampaign)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('emailcampaign_delete', array('id' => $emailCampaign->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
