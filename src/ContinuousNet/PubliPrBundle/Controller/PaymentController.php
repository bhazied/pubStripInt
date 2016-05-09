<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\Payment;
use ContinuousNet\PubliPrBundle\Form\PaymentType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Payment Controller
 * 
 * Manage Payments 
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
 * @see		PaymentController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/payment")
 */
class PaymentController extends BaseController
{
	/**
	 * Lists all Payment entities.
	 *
	 * @Route("/", name="payment_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$payments = $em->getRepository('PubliPrBundle:Payment')->findAll();

		return $this->render('PubliPrBundle:Payment:index.html.twig', array(
			'payments' => $payments,
		));
	}

	/**
	 * Creates a new Payment entity.
	 *
	 * @Route("/new", name="payment_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$payment = new Payment();
		$form = $this->createForm('ContinuousNet\PubliPrBundle\Form\PaymentType', $payment);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($payment);
			$em->flush();

			return $this->redirectToRoute('payment_show', array('id' => $payment->getId()));
		}

		return $this->render('PubliPrBundle:Payment:new.html.twig', array(
			'payment' => $payment,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Payment entity.
	 *
	 * @Route("/{id}", name="payment_show")
	 * @Method("GET")
	 */
	public function showAction(Payment $payment)
	{
		$deleteForm = $this->createDeleteForm($payment);

		return $this->render('PubliPrBundle:Payment:show.html.twig', array(
			'payment' => $payment,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Payment entity.
	 *
	 * @Route("/{id}/edit", name="payment_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Payment $payment)
	{
		$deleteForm = $this->createDeleteForm($payment);
		$editForm = $this->createForm('ContinuousNet\PubliPrBundle\Form\PaymentType', $payment);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($payment);
			$em->flush();

			return $this->redirectToRoute('payment_edit', array('id' => $payment->getId()));
		}

		return $this->render('PubliPrBundle:Payment:edit.html.twig', array(
			'payment' => $payment,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Payment entity.
	 *
	 * @Route("/{id}", name="payment_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Payment $payment)
	{
		$form = $this->createDeleteForm($payment);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($payment);
			$em->flush();
		}

		return $this->redirectToRoute('payment_index');
	}

	/**
	 * Creates a form to delete a Payment entity.
	 *
	 * @param Payment $payment The Payment entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Payment $payment)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('payment_delete', array('id' => $payment->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
