<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\PostCategory;
use ContinuousNet\SportClubBundle\Form\PostCategoryType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Post Category Controller
 * 
 * Manage PostCategories 
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
 * @see		PostCategoryController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/postcategory")
 */
class PostCategoryController extends BaseController
{
	/**
	 * Lists all PostCategory entities.
	 *
	 * @Route("/", name="postcategory_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$postCategories = $em->getRepository('SportClubBundle:PostCategory')->findAll();

		return $this->render('SportClubBundle:PostCategory:index.html.twig', array(
			'postCategories' => $postCategories,
		));
	}

	/**
	 * Creates a new PostCategory entity.
	 *
	 * @Route("/new", name="postcategory_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$postCategory = new PostCategory();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\PostCategoryType', $postCategory);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($postCategory);
			$em->flush();

			return $this->redirectToRoute('postcategory_show', array('id' => $postCategory->getId()));
		}

		return $this->render('SportClubBundle:PostCategory:new.html.twig', array(
			'postCategory' => $postCategory,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a PostCategory entity.
	 *
	 * @Route("/{id}", name="postcategory_show")
	 * @Method("GET")
	 */
	public function showAction(PostCategory $postCategory)
	{
		$deleteForm = $this->createDeleteForm($postCategory);

		return $this->render('SportClubBundle:PostCategory:show.html.twig', array(
			'postCategory' => $postCategory,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing PostCategory entity.
	 *
	 * @Route("/{id}/edit", name="postcategory_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, PostCategory $postCategory)
	{
		$deleteForm = $this->createDeleteForm($postCategory);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\PostCategoryType', $postCategory);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($postCategory);
			$em->flush();

			return $this->redirectToRoute('postcategory_edit', array('id' => $postCategory->getId()));
		}

		return $this->render('SportClubBundle:PostCategory:edit.html.twig', array(
			'postCategory' => $postCategory,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a PostCategory entity.
	 *
	 * @Route("/{id}", name="postcategory_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, PostCategory $postCategory)
	{
		$form = $this->createDeleteForm($postCategory);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($postCategory);
			$em->flush();
		}

		return $this->redirectToRoute('postcategory_index');
	}

	/**
	 * Creates a form to delete a PostCategory entity.
	 *
	 * @param PostCategory $postCategory The PostCategory entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(PostCategory $postCategory)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('postcategory_delete', array('id' => $postCategory->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
