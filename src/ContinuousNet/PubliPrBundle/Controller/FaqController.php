<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\Faq;
use ContinuousNet\PubliPrBundle\Form\FaqType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Faq Controller
 * 
 * Manage Faqs 
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
 * @see		FaqController
 * @since	  Class available since Release 1.0
 * @access	 public
 * @Route("/faq")
 */
class FaqController extends BaseController
{
	/**
	 * Lists all Faq entities.
	 *
	 * @Route("/", name="faq_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$faqs = $em->getRepository('PubliPrBundle:Faq')->findAll();

		return $this->render('PubliPrBundle:Faq:index.html.twig', array(
			'faqs' => $faqs,
		));
	}

	/**
	 * Creates a new Faq entity.
	 *
	 * @Route("/new", name="faq_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$faq = new Faq();
		$form = $this->createForm('ContinuousNet\PubliPrBundle\Form\FaqType', $faq);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($faq);
			$em->flush();

			return $this->redirectToRoute('faq_show', array('id' => $faq->getId()));
		}

		return $this->render('PubliPrBundle:Faq:new.html.twig', array(
			'faq' => $faq,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Faq entity.
	 *
	 * @Route("/{id}", name="faq_show")
	 * @Method("GET")
	 */
	public function showAction(Faq $faq)
	{
		$deleteForm = $this->createDeleteForm($faq);

		return $this->render('PubliPrBundle:Faq:show.html.twig', array(
			'faq' => $faq,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Faq entity.
	 *
	 * @Route("/{id}/edit", name="faq_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Faq $faq)
	{
		$deleteForm = $this->createDeleteForm($faq);
		$editForm = $this->createForm('ContinuousNet\PubliPrBundle\Form\FaqType', $faq);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($faq);
			$em->flush();

			return $this->redirectToRoute('faq_edit', array('id' => $faq->getId()));
		}

		return $this->render('PubliPrBundle:Faq:edit.html.twig', array(
			'faq' => $faq,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Faq entity.
	 *
	 * @Route("/{id}", name="faq_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Faq $faq)
	{
		$form = $this->createDeleteForm($faq);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($faq);
			$em->flush();
		}

		return $this->redirectToRoute('faq_index');
	}

	/**
	 * Creates a form to delete a Faq entity.
	 *
	 * @param Faq $faq The Faq entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Faq $faq)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('faq_delete', array('id' => $faq->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
