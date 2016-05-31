<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\Contact;
use ContinuousNet\PubliPrBundle\Form\ContactType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Contact Controller
 * 
 * Manage Contacts 
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
 * @see		ContactController
 * @since	  Class available since Release 1.0
 * @access	 public
 * @Route("/contact")
 */
class ContactController extends BaseController
{
	/**
	 * Lists all Contact entities.
	 *
	 * @Route("/", name="contact_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$contacts = $em->getRepository('PubliPrBundle:Contact')->findAll();

		return $this->render('PubliPrBundle:Contact:index.html.twig', array(
			'contacts' => $contacts,
		));
	}

	/**
	 * Creates a new Contact entity.
	 *
	 * @Route("/new", name="contact_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$contact = new Contact();
		$form = $this->createForm('ContinuousNet\PubliPrBundle\Form\ContactType', $contact);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($contact);
			$em->flush();

			return $this->redirectToRoute('contact_show', array('id' => $contact->getId()));
		}

		return $this->render('PubliPrBundle:Contact:new.html.twig', array(
			'contact' => $contact,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Contact entity.
	 *
	 * @Route("/{id}", name="contact_show")
	 * @Method("GET")
	 */
	public function showAction(Contact $contact)
	{
		$deleteForm = $this->createDeleteForm($contact);

		return $this->render('PubliPrBundle:Contact:show.html.twig', array(
			'contact' => $contact,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Contact entity.
	 *
	 * @Route("/{id}/edit", name="contact_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Contact $contact)
	{
		$deleteForm = $this->createDeleteForm($contact);
		$editForm = $this->createForm('ContinuousNet\PubliPrBundle\Form\ContactType', $contact);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($contact);
			$em->flush();

			return $this->redirectToRoute('contact_edit', array('id' => $contact->getId()));
		}

		return $this->render('PubliPrBundle:Contact:edit.html.twig', array(
			'contact' => $contact,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Contact entity.
	 *
	 * @Route("/{id}", name="contact_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Contact $contact)
	{
		$form = $this->createDeleteForm($contact);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($contact);
			$em->flush();
		}

		return $this->redirectToRoute('contact_index');
	}

	/**
	 * Creates a form to delete a Contact entity.
	 *
	 * @param Contact $contact The Contact entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Contact $contact)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('contact_delete', array('id' => $contact->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
