<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\EmailTemplate;
use ContinuousNet\PubliPrBundle\Form\EmailTemplateType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Email Template Controller
 * 
 * Manage EmailTemplates 
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
 * @see		EmailTemplateController
 * @since	  Class available since Release 1.0
 * @access	 public
 * @Route("/emailtemplate")
 */
class EmailTemplateController extends BaseController
{
	/**
	 * Lists all EmailTemplate entities.
	 *
	 * @Route("/", name="emailtemplate_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$emailTemplates = $em->getRepository('PubliPrBundle:EmailTemplate')->findAll();

		return $this->render('PubliPrBundle:EmailTemplate:index.html.twig', array(
			'emailTemplates' => $emailTemplates,
		));
	}

	/**
	 * Creates a new EmailTemplate entity.
	 *
	 * @Route("/new", name="emailtemplate_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$emailTemplate = new EmailTemplate();
		$form = $this->createForm('ContinuousNet\PubliPrBundle\Form\EmailTemplateType', $emailTemplate);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($emailTemplate);
			$em->flush();

			return $this->redirectToRoute('emailtemplate_show', array('id' => $emailTemplate->getId()));
		}

		return $this->render('PubliPrBundle:EmailTemplate:new.html.twig', array(
			'emailTemplate' => $emailTemplate,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a EmailTemplate entity.
	 *
	 * @Route("/{id}", name="emailtemplate_show")
	 * @Method("GET")
	 */
	public function showAction(EmailTemplate $emailTemplate)
	{
		$deleteForm = $this->createDeleteForm($emailTemplate);

		return $this->render('PubliPrBundle:EmailTemplate:show.html.twig', array(
			'emailTemplate' => $emailTemplate,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing EmailTemplate entity.
	 *
	 * @Route("/{id}/edit", name="emailtemplate_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, EmailTemplate $emailTemplate)
	{
		$deleteForm = $this->createDeleteForm($emailTemplate);
		$editForm = $this->createForm('ContinuousNet\PubliPrBundle\Form\EmailTemplateType', $emailTemplate);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($emailTemplate);
			$em->flush();

			return $this->redirectToRoute('emailtemplate_edit', array('id' => $emailTemplate->getId()));
		}

		return $this->render('PubliPrBundle:EmailTemplate:edit.html.twig', array(
			'emailTemplate' => $emailTemplate,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a EmailTemplate entity.
	 *
	 * @Route("/{id}", name="emailtemplate_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, EmailTemplate $emailTemplate)
	{
		$form = $this->createDeleteForm($emailTemplate);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($emailTemplate);
			$em->flush();
		}

		return $this->redirectToRoute('emailtemplate_index');
	}

	/**
	 * Creates a form to delete a EmailTemplate entity.
	 *
	 * @param EmailTemplate $emailTemplate The EmailTemplate entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(EmailTemplate $emailTemplate)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('emailtemplate_delete', array('id' => $emailTemplate->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
