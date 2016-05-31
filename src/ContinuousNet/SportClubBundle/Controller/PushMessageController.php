<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\PushMessage;
use ContinuousNet\SportClubBundle\Form\PushMessageType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Push Message Controller
 * 
 * Manage PushMessages 
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
 * @see		PushMessageController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/pushmessage")
 */
class PushMessageController extends BaseController
{
	/**
	 * Lists all PushMessage entities.
	 *
	 * @Route("/", name="pushmessage_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$pushMessages = $em->getRepository('SportClubBundle:PushMessage')->findAll();

		return $this->render('SportClubBundle:PushMessage:index.html.twig', array(
			'pushMessages' => $pushMessages,
		));
	}

	/**
	 * Creates a new PushMessage entity.
	 *
	 * @Route("/new", name="pushmessage_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$pushMessage = new PushMessage();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\PushMessageType', $pushMessage);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($pushMessage);
			$em->flush();

			return $this->redirectToRoute('pushmessage_show', array('id' => $pushMessage->getId()));
		}

		return $this->render('SportClubBundle:PushMessage:new.html.twig', array(
			'pushMessage' => $pushMessage,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a PushMessage entity.
	 *
	 * @Route("/{id}", name="pushmessage_show")
	 * @Method("GET")
	 */
	public function showAction(PushMessage $pushMessage)
	{
		$deleteForm = $this->createDeleteForm($pushMessage);

		return $this->render('SportClubBundle:PushMessage:show.html.twig', array(
			'pushMessage' => $pushMessage,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing PushMessage entity.
	 *
	 * @Route("/{id}/edit", name="pushmessage_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, PushMessage $pushMessage)
	{
		$deleteForm = $this->createDeleteForm($pushMessage);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\PushMessageType', $pushMessage);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($pushMessage);
			$em->flush();

			return $this->redirectToRoute('pushmessage_edit', array('id' => $pushMessage->getId()));
		}

		return $this->render('SportClubBundle:PushMessage:edit.html.twig', array(
			'pushMessage' => $pushMessage,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a PushMessage entity.
	 *
	 * @Route("/{id}", name="pushmessage_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, PushMessage $pushMessage)
	{
		$form = $this->createDeleteForm($pushMessage);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($pushMessage);
			$em->flush();
		}

		return $this->redirectToRoute('pushmessage_index');
	}

	/**
	 * Creates a form to delete a PushMessage entity.
	 *
	 * @param PushMessage $pushMessage The PushMessage entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(PushMessage $pushMessage)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('pushmessage_delete', array('id' => $pushMessage->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
