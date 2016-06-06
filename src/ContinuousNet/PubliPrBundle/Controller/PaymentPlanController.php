<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\PaymentPlan;
use ContinuousNet\PubliPrBundle\Form\PaymentPlanType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Payment Plan Controller
 * 
 * Manage PaymentPlans 
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
 * @see		PaymentPlanController
 * @since	  Class available since Release 1.0
 * @access	 public
 * @Route("/paymentplan")
 */
class PaymentPlanController extends BaseController
{
	/**
	 * Lists all PaymentPlan entities.
	 *
	 * @Route("/", name="paymentplan_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$paymentPlans = $em->getRepository('PubliPrBundle:PaymentPlan')->findAll();

		return $this->render('PubliPrBundle:PaymentPlan:index.html.twig', array(
			'paymentPlans' => $paymentPlans,
		));
	}

	/**
	 * Creates a new PaymentPlan entity.
	 *
	 * @Route("/new", name="paymentplan_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$paymentPlan = new PaymentPlan();
		$form = $this->createForm('ContinuousNet\PubliPrBundle\Form\PaymentPlanType', $paymentPlan);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($paymentPlan);
			$em->flush();

			return $this->redirectToRoute('paymentplan_show', array('id' => $paymentPlan->getId()));
		}

		return $this->render('PubliPrBundle:PaymentPlan:new.html.twig', array(
			'paymentPlan' => $paymentPlan,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a PaymentPlan entity.
	 *
	 * @Route("/{id}", name="paymentplan_show")
	 * @Method("GET")
	 */
	public function showAction(PaymentPlan $paymentPlan)
	{
		$deleteForm = $this->createDeleteForm($paymentPlan);

		return $this->render('PubliPrBundle:PaymentPlan:show.html.twig', array(
			'paymentPlan' => $paymentPlan,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing PaymentPlan entity.
	 *
	 * @Route("/{id}/edit", name="paymentplan_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, PaymentPlan $paymentPlan)
	{
		$deleteForm = $this->createDeleteForm($paymentPlan);
		$editForm = $this->createForm('ContinuousNet\PubliPrBundle\Form\PaymentPlanType', $paymentPlan);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($paymentPlan);
			$em->flush();

			return $this->redirectToRoute('paymentplan_edit', array('id' => $paymentPlan->getId()));
		}

		return $this->render('PubliPrBundle:PaymentPlan:edit.html.twig', array(
			'paymentPlan' => $paymentPlan,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a PaymentPlan entity.
	 *
	 * @Route("/{id}", name="paymentplan_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, PaymentPlan $paymentPlan)
	{
		$form = $this->createDeleteForm($paymentPlan);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($paymentPlan);
			$em->flush();
		}

		return $this->redirectToRoute('paymentplan_index');
	}

	/**
	 * Creates a form to delete a PaymentPlan entity.
	 *
	 * @param PaymentPlan $paymentPlan The PaymentPlan entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(PaymentPlan $paymentPlan)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('paymentplan_delete', array('id' => $paymentPlan->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
