<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Price;
use ContinuousNet\SportClubBundle\Form\PriceType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Price Controller
 * 
 * Manage Prices 
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
 * @see		PriceController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/price")
 */
class PriceController extends BaseController
{
	/**
	 * Lists all Price entities.
	 *
	 * @Route("/", name="price_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$prices = $em->getRepository('SportClubBundle:Price')->findAll();

		return $this->render('SportClubBundle:Price:index.html.twig', array(
			'prices' => $prices,
		));
	}

	/**
	 * Creates a new Price entity.
	 *
	 * @Route("/new", name="price_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$price = new Price();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\PriceType', $price);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($price);
			$em->flush();

			return $this->redirectToRoute('price_show', array('id' => $price->getId()));
		}

		return $this->render('SportClubBundle:Price:new.html.twig', array(
			'price' => $price,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Price entity.
	 *
	 * @Route("/{id}", name="price_show")
	 * @Method("GET")
	 */
	public function showAction(Price $price)
	{
		$deleteForm = $this->createDeleteForm($price);

		return $this->render('SportClubBundle:Price:show.html.twig', array(
			'price' => $price,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Price entity.
	 *
	 * @Route("/{id}/edit", name="price_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Price $price)
	{
		$deleteForm = $this->createDeleteForm($price);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\PriceType', $price);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($price);
			$em->flush();

			return $this->redirectToRoute('price_edit', array('id' => $price->getId()));
		}

		return $this->render('SportClubBundle:Price:edit.html.twig', array(
			'price' => $price,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Price entity.
	 *
	 * @Route("/{id}", name="price_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Price $price)
	{
		$form = $this->createDeleteForm($price);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($price);
			$em->flush();
		}

		return $this->redirectToRoute('price_index');
	}

	/**
	 * Creates a form to delete a Price entity.
	 *
	 * @param Price $price The Price entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Price $price)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('price_delete', array('id' => $price->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
