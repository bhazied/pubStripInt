<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\ImageCategory;
use ContinuousNet\SportClubBundle\Form\ImageCategoryType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Image Category Controller
 * 
 * Manage ImageCategories 
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
 * @see		ImageCategoryController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/imagecategory")
 */
class ImageCategoryController extends BaseController
{
	/**
	 * Lists all ImageCategory entities.
	 *
	 * @Route("/", name="imagecategory_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$imageCategories = $em->getRepository('SportClubBundle:ImageCategory')->findAll();

		return $this->render('SportClubBundle:ImageCategory:index.html.twig', array(
			'imageCategories' => $imageCategories,
		));
	}

	/**
	 * Creates a new ImageCategory entity.
	 *
	 * @Route("/new", name="imagecategory_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$imageCategory = new ImageCategory();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\ImageCategoryType', $imageCategory);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($imageCategory);
			$em->flush();

			return $this->redirectToRoute('imagecategory_show', array('id' => $imageCategory->getId()));
		}

		return $this->render('SportClubBundle:ImageCategory:new.html.twig', array(
			'imageCategory' => $imageCategory,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a ImageCategory entity.
	 *
	 * @Route("/{id}", name="imagecategory_show")
	 * @Method("GET")
	 */
	public function showAction(ImageCategory $imageCategory)
	{
		$deleteForm = $this->createDeleteForm($imageCategory);

		return $this->render('SportClubBundle:ImageCategory:show.html.twig', array(
			'imageCategory' => $imageCategory,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing ImageCategory entity.
	 *
	 * @Route("/{id}/edit", name="imagecategory_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, ImageCategory $imageCategory)
	{
		$deleteForm = $this->createDeleteForm($imageCategory);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\ImageCategoryType', $imageCategory);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($imageCategory);
			$em->flush();

			return $this->redirectToRoute('imagecategory_edit', array('id' => $imageCategory->getId()));
		}

		return $this->render('SportClubBundle:ImageCategory:edit.html.twig', array(
			'imageCategory' => $imageCategory,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a ImageCategory entity.
	 *
	 * @Route("/{id}", name="imagecategory_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, ImageCategory $imageCategory)
	{
		$form = $this->createDeleteForm($imageCategory);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($imageCategory);
			$em->flush();
		}

		return $this->redirectToRoute('imagecategory_index');
	}

	/**
	 * Creates a form to delete a ImageCategory entity.
	 *
	 * @param ImageCategory $imageCategory The ImageCategory entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(ImageCategory $imageCategory)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('imagecategory_delete', array('id' => $imageCategory->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
