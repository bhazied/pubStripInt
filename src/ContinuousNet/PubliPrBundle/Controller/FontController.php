<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\Font;
use ContinuousNet\PubliPrBundle\Form\FontType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Font Controller
 * 
 * Manage Fonts 
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
 * @see		FontController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/font")
 */
class FontController extends BaseController
{
	/**
	 * Lists all Font entities.
	 *
	 * @Route("/", name="font_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$fonts = $em->getRepository('PubliPrBundle:Font')->findAll();

		return $this->render('PubliPrBundle:Font:index.html.twig', array(
			'fonts' => $fonts,
		));
	}

	/**
	 * Creates a new Font entity.
	 *
	 * @Route("/new", name="font_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$font = new Font();
		$form = $this->createForm('ContinuousNet\PubliPrBundle\Form\FontType', $font);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($font);
			$em->flush();

			return $this->redirectToRoute('font_show', array('id' => $font->getId()));
		}

		return $this->render('PubliPrBundle:Font:new.html.twig', array(
			'font' => $font,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Font entity.
	 *
	 * @Route("/{id}", name="font_show")
	 * @Method("GET")
	 */
	public function showAction(Font $font)
	{
		$deleteForm = $this->createDeleteForm($font);

		return $this->render('PubliPrBundle:Font:show.html.twig', array(
			'font' => $font,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Font entity.
	 *
	 * @Route("/{id}/edit", name="font_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Font $font)
	{
		$deleteForm = $this->createDeleteForm($font);
		$editForm = $this->createForm('ContinuousNet\PubliPrBundle\Form\FontType', $font);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($font);
			$em->flush();

			return $this->redirectToRoute('font_edit', array('id' => $font->getId()));
		}

		return $this->render('PubliPrBundle:Font:edit.html.twig', array(
			'font' => $font,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Font entity.
	 *
	 * @Route("/{id}", name="font_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Font $font)
	{
		$form = $this->createDeleteForm($font);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($font);
			$em->flush();
		}

		return $this->redirectToRoute('font_index');
	}

	/**
	 * Creates a form to delete a Font entity.
	 *
	 * @param Font $font The Font entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Font $font)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('font_delete', array('id' => $font->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
