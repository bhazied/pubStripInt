<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Comment;
use ContinuousNet\SportClubBundle\Form\CommentType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Comment Controller
 * 
 * Manage Comments 
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
 * @see		CommentController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/comment")
 */
class CommentController extends BaseController
{
	/**
	 * Lists all Comment entities.
	 *
	 * @Route("/", name="comment_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$comments = $em->getRepository('SportClubBundle:Comment')->findAll();

		return $this->render('SportClubBundle:Comment:index.html.twig', array(
			'comments' => $comments,
		));
	}

	/**
	 * Creates a new Comment entity.
	 *
	 * @Route("/new", name="comment_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$comment = new Comment();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\CommentType', $comment);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($comment);
			$em->flush();

			return $this->redirectToRoute('comment_show', array('id' => $comment->getId()));
		}

		return $this->render('SportClubBundle:Comment:new.html.twig', array(
			'comment' => $comment,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Comment entity.
	 *
	 * @Route("/{id}", name="comment_show")
	 * @Method("GET")
	 */
	public function showAction(Comment $comment)
	{
		$deleteForm = $this->createDeleteForm($comment);

		return $this->render('SportClubBundle:Comment:show.html.twig', array(
			'comment' => $comment,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Comment entity.
	 *
	 * @Route("/{id}/edit", name="comment_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Comment $comment)
	{
		$deleteForm = $this->createDeleteForm($comment);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\CommentType', $comment);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($comment);
			$em->flush();

			return $this->redirectToRoute('comment_edit', array('id' => $comment->getId()));
		}

		return $this->render('SportClubBundle:Comment:edit.html.twig', array(
			'comment' => $comment,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Comment entity.
	 *
	 * @Route("/{id}", name="comment_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Comment $comment)
	{
		$form = $this->createDeleteForm($comment);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($comment);
			$em->flush();
		}

		return $this->redirectToRoute('comment_index');
	}

	/**
	 * Creates a form to delete a Comment entity.
	 *
	 * @param Comment $comment The Comment entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Comment $comment)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('comment_delete', array('id' => $comment->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
