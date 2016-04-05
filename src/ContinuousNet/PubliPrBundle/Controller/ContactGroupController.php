<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\ContactGroup;
use ContinuousNet\PubliPrBundle\Form\ContactGroupType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Contact Group Controller
 * 
 * Manage ContactGroups 
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
 * @see		ContactGroupController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/contactgroup")
 */
class ContactGroupController extends BaseController
{
	/**
	 * Lists all ContactGroup entities.
	 *
	 * @Route("/", name="contactgroup_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$contactGroups = $em->getRepository('PubliPrBundle:ContactGroup')->findAll();

		return $this->render('PubliPrBundle:ContactGroup:index.html.twig', array(
			'contactGroups' => $contactGroups,
		));
	}

	/**
	 * Creates a new ContactGroup entity.
	 *
	 * @Route("/new", name="contactgroup_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$contactGroup = new ContactGroup();
		$form = $this->createForm('ContinuousNet\PubliPrBundle\Form\ContactGroupType', $contactGroup);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($contactGroup);
			$em->flush();

			return $this->redirectToRoute('contactgroup_show', array('id' => $contactGroup->getId()));
		}

		return $this->render('PubliPrBundle:ContactGroup:new.html.twig', array(
			'contactGroup' => $contactGroup,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a ContactGroup entity.
	 *
	 * @Route("/{id}", name="contactgroup_show")
	 * @Method("GET")
	 */
	public function showAction(ContactGroup $contactGroup)
	{
		$deleteForm = $this->createDeleteForm($contactGroup);

		return $this->render('PubliPrBundle:ContactGroup:show.html.twig', array(
			'contactGroup' => $contactGroup,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing ContactGroup entity.
	 *
	 * @Route("/{id}/edit", name="contactgroup_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, ContactGroup $contactGroup)
	{
		$deleteForm = $this->createDeleteForm($contactGroup);
		$editForm = $this->createForm('ContinuousNet\PubliPrBundle\Form\ContactGroupType', $contactGroup);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($contactGroup);
			$em->flush();

			return $this->redirectToRoute('contactgroup_edit', array('id' => $contactGroup->getId()));
		}

		return $this->render('PubliPrBundle:ContactGroup:edit.html.twig', array(
			'contactGroup' => $contactGroup,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a ContactGroup entity.
	 *
	 * @Route("/{id}", name="contactgroup_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, ContactGroup $contactGroup)
	{
		$form = $this->createDeleteForm($contactGroup);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($contactGroup);
			$em->flush();
		}

		return $this->redirectToRoute('contactgroup_index');
	}

	/**
	 * Creates a form to delete a ContactGroup entity.
	 *
	 * @param ContactGroup $contactGroup The ContactGroup entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(ContactGroup $contactGroup)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('contactgroup_delete', array('id' => $contactGroup->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
