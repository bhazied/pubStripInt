<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\PostType;
use ContinuousNet\SportClubBundle\Form\PostTypeType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Post Type Controller
 * 
 * Manage PostTypes 
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
 * @see		PostTypeController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/posttype")
 */
class PostTypeController extends BaseController
{
	/**
	 * Lists all PostType entities.
	 *
	 * @Route("/", name="posttype_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$postTypes = $em->getRepository('SportClubBundle:PostType')->findAll();

		return $this->render('SportClubBundle:PostType:index.html.twig', array(
			'postTypes' => $postTypes,
		));
	}

	/**
	 * Creates a new PostType entity.
	 *
	 * @Route("/new", name="posttype_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$postType = new PostType();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\PostTypeType', $postType);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($postType);
			$em->flush();

			return $this->redirectToRoute('posttype_show', array('id' => $postType->getId()));
		}

		return $this->render('SportClubBundle:PostType:new.html.twig', array(
			'postType' => $postType,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a PostType entity.
	 *
	 * @Route("/{id}", name="posttype_show")
	 * @Method("GET")
	 */
	public function showAction(PostType $postType)
	{
		$deleteForm = $this->createDeleteForm($postType);

		return $this->render('SportClubBundle:PostType:show.html.twig', array(
			'postType' => $postType,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing PostType entity.
	 *
	 * @Route("/{id}/edit", name="posttype_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, PostType $postType)
	{
		$deleteForm = $this->createDeleteForm($postType);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\PostTypeType', $postType);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($postType);
			$em->flush();

			return $this->redirectToRoute('posttype_edit', array('id' => $postType->getId()));
		}

		return $this->render('SportClubBundle:PostType:edit.html.twig', array(
			'postType' => $postType,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a PostType entity.
	 *
	 * @Route("/{id}", name="posttype_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, PostType $postType)
	{
		$form = $this->createDeleteForm($postType);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($postType);
			$em->flush();
		}

		return $this->redirectToRoute('posttype_index');
	}

	/**
	 * Creates a form to delete a PostType entity.
	 *
	 * @param PostType $postType The PostType entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(PostType $postType)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('posttype_delete', array('id' => $postType->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
