<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Voucher;
use ContinuousNet\SportClubBundle\Form\VoucherType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Voucher Controller
 * 
 * Manage Vouchers 
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
 * @see		VoucherController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/voucher")
 */
class VoucherController extends BaseController
{
	/**
	 * Lists all Voucher entities.
	 *
	 * @Route("/", name="voucher_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$vouchers = $em->getRepository('SportClubBundle:Voucher')->findAll();

		return $this->render('SportClubBundle:Voucher:index.html.twig', array(
			'vouchers' => $vouchers,
		));
	}

	/**
	 * Creates a new Voucher entity.
	 *
	 * @Route("/new", name="voucher_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$voucher = new Voucher();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\VoucherType', $voucher);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($voucher);
			$em->flush();

			return $this->redirectToRoute('voucher_show', array('id' => $voucher->getId()));
		}

		return $this->render('SportClubBundle:Voucher:new.html.twig', array(
			'voucher' => $voucher,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Voucher entity.
	 *
	 * @Route("/{id}", name="voucher_show")
	 * @Method("GET")
	 */
	public function showAction(Voucher $voucher)
	{
		$deleteForm = $this->createDeleteForm($voucher);

		return $this->render('SportClubBundle:Voucher:show.html.twig', array(
			'voucher' => $voucher,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Voucher entity.
	 *
	 * @Route("/{id}/edit", name="voucher_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Voucher $voucher)
	{
		$deleteForm = $this->createDeleteForm($voucher);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\VoucherType', $voucher);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($voucher);
			$em->flush();

			return $this->redirectToRoute('voucher_edit', array('id' => $voucher->getId()));
		}

		return $this->render('SportClubBundle:Voucher:edit.html.twig', array(
			'voucher' => $voucher,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Voucher entity.
	 *
	 * @Route("/{id}", name="voucher_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Voucher $voucher)
	{
		$form = $this->createDeleteForm($voucher);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($voucher);
			$em->flush();
		}

		return $this->redirectToRoute('voucher_index');
	}

	/**
	 * Creates a form to delete a Voucher entity.
	 *
	 * @param Voucher $voucher The Voucher entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Voucher $voucher)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('voucher_delete', array('id' => $voucher->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
