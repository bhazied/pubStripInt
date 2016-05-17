<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Notification;
use ContinuousNet\SportClubBundle\Form\NotificationType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Notification Controller
 * 
 * Manage Notifications 
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
 * @see		NotificationController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/notification")
 */
class NotificationController extends BaseController
{
	/**
	 * Lists all Notification entities.
	 *
	 * @Route("/", name="notification_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$notifications = $em->getRepository('SportClubBundle:Notification')->findAll();

		return $this->render('SportClubBundle:Notification:index.html.twig', array(
			'notifications' => $notifications,
		));
	}

	/**
	 * Creates a new Notification entity.
	 *
	 * @Route("/new", name="notification_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$notification = new Notification();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\NotificationType', $notification);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($notification);
			$em->flush();

			return $this->redirectToRoute('notification_show', array('id' => $notification->getId()));
		}

		return $this->render('SportClubBundle:Notification:new.html.twig', array(
			'notification' => $notification,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Notification entity.
	 *
	 * @Route("/{id}", name="notification_show")
	 * @Method("GET")
	 */
	public function showAction(Notification $notification)
	{
		$deleteForm = $this->createDeleteForm($notification);

		return $this->render('SportClubBundle:Notification:show.html.twig', array(
			'notification' => $notification,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Notification entity.
	 *
	 * @Route("/{id}/edit", name="notification_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Notification $notification)
	{
		$deleteForm = $this->createDeleteForm($notification);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\NotificationType', $notification);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($notification);
			$em->flush();

			return $this->redirectToRoute('notification_edit', array('id' => $notification->getId()));
		}

		return $this->render('SportClubBundle:Notification:edit.html.twig', array(
			'notification' => $notification,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Notification entity.
	 *
	 * @Route("/{id}", name="notification_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Notification $notification)
	{
		$form = $this->createDeleteForm($notification);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($notification);
			$em->flush();
		}

		return $this->redirectToRoute('notification_index');
	}

	/**
	 * Creates a form to delete a Notification entity.
	 *
	 * @param Notification $notification The Notification entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Notification $notification)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('notification_delete', array('id' => $notification->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
