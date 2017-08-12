<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\UserPaymentPlan;
use ContinuousNet\PubliPrBundle\Form\UserPaymentPlanType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * User Payment Plan Controller
 * 
 * Manage UserPaymentPlans 
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
 * @see		UserPaymentPlanController
 * @since	  Class available since Release 1.0
 * @access	 public
 * @Route("/userpaymentplan")
 */
class UserPaymentPlanController extends BaseController
{
	/**
	 * Lists all UserPaymentPlan entities.
	 *
	 * @Route("/", name="userpaymentplan_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$userPaymentPlans = $em->getRepository('PubliPrBundle:UserPaymentPlan')->findAll();

		return $this->render('PubliPrBundle:UserPaymentPlan:index.html.twig', array(
			'userPaymentPlans' => $userPaymentPlans,
		));
	}

	/**
	 * Creates a new UserPaymentPlan entity.
	 *
	 * @Route("/new", name="userpaymentplan_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$userPaymentPlan = new UserPaymentPlan();
		$form = $this->createForm('ContinuousNet\PubliPrBundle\Form\UserPaymentPlanType', $userPaymentPlan);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($userPaymentPlan);
			$em->flush();

			return $this->redirectToRoute('userpaymentplan_show', array('id' => $userPaymentPlan->getId()));
		}

		return $this->render('PubliPrBundle:UserPaymentPlan:new.html.twig', array(
			'userPaymentPlan' => $userPaymentPlan,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a UserPaymentPlan entity.
	 *
	 * @Route("/{id}", name="userpaymentplan_show")
	 * @Method("GET")
	 */
	public function showAction(UserPaymentPlan $userPaymentPlan)
	{
		$deleteForm = $this->createDeleteForm($userPaymentPlan);

		return $this->render('PubliPrBundle:UserPaymentPlan:show.html.twig', array(
			'userPaymentPlan' => $userPaymentPlan,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing UserPaymentPlan entity.
	 *
	 * @Route("/{id}/edit", name="userpaymentplan_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, UserPaymentPlan $userPaymentPlan)
	{
		$deleteForm = $this->createDeleteForm($userPaymentPlan);
		$editForm = $this->createForm('ContinuousNet\PubliPrBundle\Form\UserPaymentPlanType', $userPaymentPlan);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($userPaymentPlan);
			$em->flush();

			return $this->redirectToRoute('userpaymentplan_edit', array('id' => $userPaymentPlan->getId()));
		}

		return $this->render('PubliPrBundle:UserPaymentPlan:edit.html.twig', array(
			'userPaymentPlan' => $userPaymentPlan,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a UserPaymentPlan entity.
	 *
	 * @Route("/{id}", name="userpaymentplan_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, UserPaymentPlan $userPaymentPlan)
	{
		$form = $this->createDeleteForm($userPaymentPlan);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($userPaymentPlan);
			$em->flush();
		}

		return $this->redirectToRoute('userpaymentplan_index');
	}

	/**
	 * Creates a form to delete a UserPaymentPlan entity.
	 *
	 * @param UserPaymentPlan $userPaymentPlan The UserPaymentPlan entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(UserPaymentPlan $userPaymentPlan)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('userpaymentplan_delete', array('id' => $userPaymentPlan->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
