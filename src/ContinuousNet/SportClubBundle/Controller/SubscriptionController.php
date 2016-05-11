<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Subscription;
use ContinuousNet\SportClubBundle\Form\SubscriptionType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Subscription Controller
 * 
 * Manage Subscriptions 
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
 * @see		SubscriptionController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/subscription")
 */
class SubscriptionController extends BaseController
{
	/**
	 * Lists all Subscription entities.
	 *
	 * @Route("/", name="subscription_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$subscriptions = $em->getRepository('SportClubBundle:Subscription')->findAll();

		return $this->render('SportClubBundle:Subscription:index.html.twig', array(
			'subscriptions' => $subscriptions,
		));
	}

	/**
	 * Creates a new Subscription entity.
	 *
	 * @Route("/new", name="subscription_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$subscription = new Subscription();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\SubscriptionType', $subscription);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($subscription);
			$em->flush();

			return $this->redirectToRoute('subscription_show', array('id' => $subscription->getId()));
		}

		return $this->render('SportClubBundle:Subscription:new.html.twig', array(
			'subscription' => $subscription,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Subscription entity.
	 *
	 * @Route("/{id}", name="subscription_show")
	 * @Method("GET")
	 */
	public function showAction(Subscription $subscription)
	{
		$deleteForm = $this->createDeleteForm($subscription);

		return $this->render('SportClubBundle:Subscription:show.html.twig', array(
			'subscription' => $subscription,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Subscription entity.
	 *
	 * @Route("/{id}/edit", name="subscription_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Subscription $subscription)
	{
		$deleteForm = $this->createDeleteForm($subscription);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\SubscriptionType', $subscription);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($subscription);
			$em->flush();

			return $this->redirectToRoute('subscription_edit', array('id' => $subscription->getId()));
		}

		return $this->render('SportClubBundle:Subscription:edit.html.twig', array(
			'subscription' => $subscription,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Subscription entity.
	 *
	 * @Route("/{id}", name="subscription_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Subscription $subscription)
	{
		$form = $this->createDeleteForm($subscription);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($subscription);
			$em->flush();
		}

		return $this->redirectToRoute('subscription_index');
	}

	/**
	 * Creates a form to delete a Subscription entity.
	 *
	 * @param Subscription $subscription The Subscription entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Subscription $subscription)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('subscription_delete', array('id' => $subscription->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
