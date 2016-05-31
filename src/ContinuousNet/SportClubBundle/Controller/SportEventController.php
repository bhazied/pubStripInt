<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\SportEvent;
use ContinuousNet\SportClubBundle\Form\SportEventType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Sport Event Controller
 * 
 * Manage SportEvents 
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
 * @see		SportEventController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/sportevent")
 */
class SportEventController extends BaseController
{
	/**
	 * Lists all SportEvent entities.
	 *
	 * @Route("/", name="sportevent_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$sportEvents = $em->getRepository('SportClubBundle:SportEvent')->findAll();

		return $this->render('SportClubBundle:SportEvent:index.html.twig', array(
			'sportEvents' => $sportEvents,
		));
	}

	/**
	 * Creates a new SportEvent entity.
	 *
	 * @Route("/new", name="sportevent_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$sportEvent = new SportEvent();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\SportEventType', $sportEvent);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($sportEvent);
			$em->flush();

			return $this->redirectToRoute('sportevent_show', array('id' => $sportEvent->getId()));
		}

		return $this->render('SportClubBundle:SportEvent:new.html.twig', array(
			'sportEvent' => $sportEvent,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a SportEvent entity.
	 *
	 * @Route("/{id}", name="sportevent_show")
	 * @Method("GET")
	 */
	public function showAction(SportEvent $sportEvent)
	{
		$deleteForm = $this->createDeleteForm($sportEvent);

		return $this->render('SportClubBundle:SportEvent:show.html.twig', array(
			'sportEvent' => $sportEvent,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing SportEvent entity.
	 *
	 * @Route("/{id}/edit", name="sportevent_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, SportEvent $sportEvent)
	{
		$deleteForm = $this->createDeleteForm($sportEvent);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\SportEventType', $sportEvent);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($sportEvent);
			$em->flush();

			return $this->redirectToRoute('sportevent_edit', array('id' => $sportEvent->getId()));
		}

		return $this->render('SportClubBundle:SportEvent:edit.html.twig', array(
			'sportEvent' => $sportEvent,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a SportEvent entity.
	 *
	 * @Route("/{id}", name="sportevent_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, SportEvent $sportEvent)
	{
		$form = $this->createDeleteForm($sportEvent);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($sportEvent);
			$em->flush();
		}

		return $this->redirectToRoute('sportevent_index');
	}

	/**
	 * Creates a form to delete a SportEvent entity.
	 *
	 * @param SportEvent $sportEvent The SportEvent entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(SportEvent $sportEvent)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('sportevent_delete', array('id' => $sportEvent->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
