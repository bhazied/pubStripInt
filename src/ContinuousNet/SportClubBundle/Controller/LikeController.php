<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Like;
use ContinuousNet\SportClubBundle\Form\LikeType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Like Controller
 * 
 * Manage Likes 
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
 * @see		LikeController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/like")
 */
class LikeController extends BaseController
{
	/**
	 * Lists all Like entities.
	 *
	 * @Route("/", name="like_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$likes = $em->getRepository('SportClubBundle:Like')->findAll();

		return $this->render('SportClubBundle:Like:index.html.twig', array(
			'likes' => $likes,
		));
	}

	/**
	 * Creates a new Like entity.
	 *
	 * @Route("/new", name="like_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$like = new Like();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\LikeType', $like);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($like);
			$em->flush();

			return $this->redirectToRoute('like_show', array('id' => $like->getId()));
		}

		return $this->render('SportClubBundle:Like:new.html.twig', array(
			'like' => $like,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Like entity.
	 *
	 * @Route("/{id}", name="like_show")
	 * @Method("GET")
	 */
	public function showAction(Like $like)
	{
		$deleteForm = $this->createDeleteForm($like);

		return $this->render('SportClubBundle:Like:show.html.twig', array(
			'like' => $like,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Like entity.
	 *
	 * @Route("/{id}/edit", name="like_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Like $like)
	{
		$deleteForm = $this->createDeleteForm($like);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\LikeType', $like);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($like);
			$em->flush();

			return $this->redirectToRoute('like_edit', array('id' => $like->getId()));
		}

		return $this->render('SportClubBundle:Like:edit.html.twig', array(
			'like' => $like,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Like entity.
	 *
	 * @Route("/{id}", name="like_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Like $like)
	{
		$form = $this->createDeleteForm($like);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($like);
			$em->flush();
		}

		return $this->redirectToRoute('like_index');
	}

	/**
	 * Creates a form to delete a Like entity.
	 *
	 * @param Like $like The Like entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Like $like)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('like_delete', array('id' => $like->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
