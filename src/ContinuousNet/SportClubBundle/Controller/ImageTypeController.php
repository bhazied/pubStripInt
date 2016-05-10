<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\ImageType;
use ContinuousNet\SportClubBundle\Form\ImageTypeType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Image Type Controller
 * 
 * Manage ImageTypes 
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
 * @see		ImageTypeController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/imagetype")
 */
class ImageTypeController extends BaseController
{
	/**
	 * Lists all ImageType entities.
	 *
	 * @Route("/", name="imagetype_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$imageTypes = $em->getRepository('SportClubBundle:ImageType')->findAll();

		return $this->render('SportClubBundle:ImageType:index.html.twig', array(
			'imageTypes' => $imageTypes,
		));
	}

	/**
	 * Creates a new ImageType entity.
	 *
	 * @Route("/new", name="imagetype_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$imageType = new ImageType();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\ImageTypeType', $imageType);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($imageType);
			$em->flush();

			return $this->redirectToRoute('imagetype_show', array('id' => $imageType->getId()));
		}

		return $this->render('SportClubBundle:ImageType:new.html.twig', array(
			'imageType' => $imageType,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a ImageType entity.
	 *
	 * @Route("/{id}", name="imagetype_show")
	 * @Method("GET")
	 */
	public function showAction(ImageType $imageType)
	{
		$deleteForm = $this->createDeleteForm($imageType);

		return $this->render('SportClubBundle:ImageType:show.html.twig', array(
			'imageType' => $imageType,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing ImageType entity.
	 *
	 * @Route("/{id}/edit", name="imagetype_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, ImageType $imageType)
	{
		$deleteForm = $this->createDeleteForm($imageType);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\ImageTypeType', $imageType);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($imageType);
			$em->flush();

			return $this->redirectToRoute('imagetype_edit', array('id' => $imageType->getId()));
		}

		return $this->render('SportClubBundle:ImageType:edit.html.twig', array(
			'imageType' => $imageType,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a ImageType entity.
	 *
	 * @Route("/{id}", name="imagetype_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, ImageType $imageType)
	{
		$form = $this->createDeleteForm($imageType);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($imageType);
			$em->flush();
		}

		return $this->redirectToRoute('imagetype_index');
	}

	/**
	 * Creates a form to delete a ImageType entity.
	 *
	 * @param ImageType $imageType The ImageType entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(ImageType $imageType)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('imagetype_delete', array('id' => $imageType->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
