<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\VideoCategory;
use ContinuousNet\SportClubBundle\Form\VideoCategoryType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Video Category Controller
 * 
 * Manage VideoCategories 
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
 * @see		VideoCategoryController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/videocategory")
 */
class VideoCategoryController extends BaseController
{
	/**
	 * Lists all VideoCategory entities.
	 *
	 * @Route("/", name="videocategory_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$videoCategories = $em->getRepository('SportClubBundle:VideoCategory')->findAll();

		return $this->render('SportClubBundle:VideoCategory:index.html.twig', array(
			'videoCategories' => $videoCategories,
		));
	}

	/**
	 * Creates a new VideoCategory entity.
	 *
	 * @Route("/new", name="videocategory_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$videoCategory = new VideoCategory();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\VideoCategoryType', $videoCategory);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($videoCategory);
			$em->flush();

			return $this->redirectToRoute('videocategory_show', array('id' => $videoCategory->getId()));
		}

		return $this->render('SportClubBundle:VideoCategory:new.html.twig', array(
			'videoCategory' => $videoCategory,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a VideoCategory entity.
	 *
	 * @Route("/{id}", name="videocategory_show")
	 * @Method("GET")
	 */
	public function showAction(VideoCategory $videoCategory)
	{
		$deleteForm = $this->createDeleteForm($videoCategory);

		return $this->render('SportClubBundle:VideoCategory:show.html.twig', array(
			'videoCategory' => $videoCategory,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing VideoCategory entity.
	 *
	 * @Route("/{id}/edit", name="videocategory_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, VideoCategory $videoCategory)
	{
		$deleteForm = $this->createDeleteForm($videoCategory);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\VideoCategoryType', $videoCategory);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($videoCategory);
			$em->flush();

			return $this->redirectToRoute('videocategory_edit', array('id' => $videoCategory->getId()));
		}

		return $this->render('SportClubBundle:VideoCategory:edit.html.twig', array(
			'videoCategory' => $videoCategory,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a VideoCategory entity.
	 *
	 * @Route("/{id}", name="videocategory_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, VideoCategory $videoCategory)
	{
		$form = $this->createDeleteForm($videoCategory);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($videoCategory);
			$em->flush();
		}

		return $this->redirectToRoute('videocategory_index');
	}

	/**
	 * Creates a form to delete a VideoCategory entity.
	 *
	 * @param VideoCategory $videoCategory The VideoCategory entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(VideoCategory $videoCategory)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('videocategory_delete', array('id' => $videoCategory->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
