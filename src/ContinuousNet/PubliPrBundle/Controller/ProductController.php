<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\Product;
use ContinuousNet\PubliPrBundle\Form\ProductType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Product Controller
 * 
 * Manage Products 
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
 * @see		ProductController
 * @since	  Class available since Release 1.0
 * @access	 public
 * @Route("/product")
 */
class ProductController extends BaseController
{
	/**
	 * Lists all Product entities.
	 *
	 * @Route("/", name="product_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$products = $em->getRepository('PubliPrBundle:Product')->findAll();

		return $this->render('PubliPrBundle:Product:index.html.twig', array(
			'products' => $products,
		));
	}

	/**
	 * Creates a new Product entity.
	 *
	 * @Route("/new", name="product_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$product = new Product();
		$form = $this->createForm('ContinuousNet\PubliPrBundle\Form\ProductType', $product);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($product);
			$em->flush();

			return $this->redirectToRoute('product_show', array('id' => $product->getId()));
		}

		return $this->render('PubliPrBundle:Product:new.html.twig', array(
			'product' => $product,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Product entity.
	 *
	 * @Route("/{id}", name="product_show")
	 * @Method("GET")
	 */
	public function showAction(Product $product)
	{
		$deleteForm = $this->createDeleteForm($product);

		return $this->render('PubliPrBundle:Product:show.html.twig', array(
			'product' => $product,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Product entity.
	 *
	 * @Route("/{id}/edit", name="product_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Product $product)
	{
		$deleteForm = $this->createDeleteForm($product);
		$editForm = $this->createForm('ContinuousNet\PubliPrBundle\Form\ProductType', $product);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($product);
			$em->flush();

			return $this->redirectToRoute('product_edit', array('id' => $product->getId()));
		}

		return $this->render('PubliPrBundle:Product:edit.html.twig', array(
			'product' => $product,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Product entity.
	 *
	 * @Route("/{id}", name="product_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Product $product)
	{
		$form = $this->createDeleteForm($product);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($product);
			$em->flush();
		}

		return $this->redirectToRoute('product_index');
	}

	/**
	 * Creates a form to delete a Product entity.
	 *
	 * @param Product $product The Product entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Product $product)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('product_delete', array('id' => $product->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
