<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Image;
use ContinuousNet\SportClubBundle\Form\ImageType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Image Controller
 * 
 * Manage Images 
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
 * @see		ImageController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/image")
 */
class ImageController extends BaseController
{
	/**
	 * Lists all Image entities.
	 *
	 * @Route("/", name="image_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$images = $em->getRepository('SportClubBundle:Image')->findAll();

		return $this->render('SportClubBundle:Image:index.html.twig', array(
			'images' => $images,
		));
	}

	/**
	 * Creates a new Image entity.
	 *
	 * @Route("/new", name="image_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$image = new Image();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\ImageType', $image);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($image);
			$em->flush();

			return $this->redirectToRoute('image_show', array('id' => $image->getId()));
		}

		return $this->render('SportClubBundle:Image:new.html.twig', array(
			'image' => $image,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Image entity.
	 *
	 * @Route("/{id}", name="image_show")
	 * @Method("GET")
	 */
	public function showAction(Image $image)
	{
		$deleteForm = $this->createDeleteForm($image);

		return $this->render('SportClubBundle:Image:show.html.twig', array(
			'image' => $image,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Image entity.
	 *
	 * @Route("/{id}/edit", name="image_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Image $image)
	{
		$deleteForm = $this->createDeleteForm($image);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\ImageType', $image);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($image);
			$em->flush();

			return $this->redirectToRoute('image_edit', array('id' => $image->getId()));
		}

		return $this->render('SportClubBundle:Image:edit.html.twig', array(
			'image' => $image,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Image entity.
	 *
	 * @Route("/{id}", name="image_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Image $image)
	{
		$form = $this->createDeleteForm($image);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($image);
			$em->flush();
		}

		return $this->redirectToRoute('image_index');
	}

	/**
	 * Creates a form to delete a Image entity.
	 *
	 * @param Image $image The Image entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Image $image)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('image_delete', array('id' => $image->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
