<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\Email;
use ContinuousNet\PubliPrBundle\Form\EmailType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Email Controller
 * 
 * Manage Emails 
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
 * @see		EmailController
 * @since	  Class available since Release 1.0
 * @access	 public
 * @Route("/email")
 */
class EmailController extends BaseController
{
	/**
	 * Lists all Email entities.
	 *
	 * @Route("/", name="email_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$emails = $em->getRepository('PubliPrBundle:Email')->findAll();

		return $this->render('PubliPrBundle:Email:index.html.twig', array(
			'emails' => $emails,
		));
	}

	/**
	 * Creates a new Email entity.
	 *
	 * @Route("/new", name="email_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$email = new Email();
		$form = $this->createForm('ContinuousNet\PubliPrBundle\Form\EmailType', $email);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($email);
			$em->flush();

			return $this->redirectToRoute('email_show', array('id' => $email->getId()));
		}

		return $this->render('PubliPrBundle:Email:new.html.twig', array(
			'email' => $email,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Email entity.
	 *
	 * @Route("/{id}", name="email_show")
	 * @Method("GET")
	 */
	public function showAction(Email $email)
	{
		$deleteForm = $this->createDeleteForm($email);

		return $this->render('PubliPrBundle:Email:show.html.twig', array(
			'email' => $email,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Email entity.
	 *
	 * @Route("/{id}/edit", name="email_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Email $email)
	{
		$deleteForm = $this->createDeleteForm($email);
		$editForm = $this->createForm('ContinuousNet\PubliPrBundle\Form\EmailType', $email);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($email);
			$em->flush();

			return $this->redirectToRoute('email_edit', array('id' => $email->getId()));
		}

		return $this->render('PubliPrBundle:Email:edit.html.twig', array(
			'email' => $email,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Email entity.
	 *
	 * @Route("/{id}", name="email_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Email $email)
	{
		$form = $this->createDeleteForm($email);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($email);
			$em->flush();
		}

		return $this->redirectToRoute('email_index');
	}

	/**
	 * Creates a form to delete a Email entity.
	 *
	 * @param Email $email The Email entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Email $email)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('email_delete', array('id' => $email->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
