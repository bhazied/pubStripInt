<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\PushNotification;
use ContinuousNet\SportClubBundle\Form\PushNotificationType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Push Notification Controller
 * 
 * Manage PushNotifications 
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
 * @see		PushNotificationController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/pushnotification")
 */
class PushNotificationController extends BaseController
{
	/**
	 * Lists all PushNotification entities.
	 *
	 * @Route("/", name="pushnotification_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$pushNotifications = $em->getRepository('SportClubBundle:PushNotification')->findAll();

		return $this->render('SportClubBundle:PushNotification:index.html.twig', array(
			'pushNotifications' => $pushNotifications,
		));
	}

	/**
	 * Creates a new PushNotification entity.
	 *
	 * @Route("/new", name="pushnotification_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$pushNotification = new PushNotification();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\PushNotificationType', $pushNotification);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($pushNotification);
			$em->flush();

			return $this->redirectToRoute('pushnotification_show', array('id' => $pushNotification->getId()));
		}

		return $this->render('SportClubBundle:PushNotification:new.html.twig', array(
			'pushNotification' => $pushNotification,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a PushNotification entity.
	 *
	 * @Route("/{id}", name="pushnotification_show")
	 * @Method("GET")
	 */
	public function showAction(PushNotification $pushNotification)
	{
		$deleteForm = $this->createDeleteForm($pushNotification);

		return $this->render('SportClubBundle:PushNotification:show.html.twig', array(
			'pushNotification' => $pushNotification,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing PushNotification entity.
	 *
	 * @Route("/{id}/edit", name="pushnotification_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, PushNotification $pushNotification)
	{
		$deleteForm = $this->createDeleteForm($pushNotification);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\PushNotificationType', $pushNotification);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($pushNotification);
			$em->flush();

			return $this->redirectToRoute('pushnotification_edit', array('id' => $pushNotification->getId()));
		}

		return $this->render('SportClubBundle:PushNotification:edit.html.twig', array(
			'pushNotification' => $pushNotification,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a PushNotification entity.
	 *
	 * @Route("/{id}", name="pushnotification_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, PushNotification $pushNotification)
	{
		$form = $this->createDeleteForm($pushNotification);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($pushNotification);
			$em->flush();
		}

		return $this->redirectToRoute('pushnotification_index');
	}

	/**
	 * Creates a form to delete a PushNotification entity.
	 *
	 * @param PushNotification $pushNotification The PushNotification entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(PushNotification $pushNotification)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('pushnotification_delete', array('id' => $pushNotification->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
