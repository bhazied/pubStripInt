<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\MatchCommentary;
use ContinuousNet\SportClubBundle\Form\MatchCommentaryType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Match Commentary Controller
 * 
 * Manage MatchCommentaries 
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
 * @see		MatchCommentaryController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/matchcommentary")
 */
class MatchCommentaryController extends BaseController
{
	/**
	 * Lists all MatchCommentary entities.
	 *
	 * @Route("/", name="matchcommentary_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$matchCommentaries = $em->getRepository('SportClubBundle:MatchCommentary')->findAll();

		return $this->render('SportClubBundle:MatchCommentary:index.html.twig', array(
			'matchCommentaries' => $matchCommentaries,
		));
	}

	/**
	 * Creates a new MatchCommentary entity.
	 *
	 * @Route("/new", name="matchcommentary_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$matchCommentary = new MatchCommentary();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\MatchCommentaryType', $matchCommentary);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($matchCommentary);
			$em->flush();

			return $this->redirectToRoute('matchcommentary_show', array('id' => $matchCommentary->getId()));
		}

		return $this->render('SportClubBundle:MatchCommentary:new.html.twig', array(
			'matchCommentary' => $matchCommentary,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a MatchCommentary entity.
	 *
	 * @Route("/{id}", name="matchcommentary_show")
	 * @Method("GET")
	 */
	public function showAction(MatchCommentary $matchCommentary)
	{
		$deleteForm = $this->createDeleteForm($matchCommentary);

		return $this->render('SportClubBundle:MatchCommentary:show.html.twig', array(
			'matchCommentary' => $matchCommentary,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing MatchCommentary entity.
	 *
	 * @Route("/{id}/edit", name="matchcommentary_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, MatchCommentary $matchCommentary)
	{
		$deleteForm = $this->createDeleteForm($matchCommentary);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\MatchCommentaryType', $matchCommentary);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($matchCommentary);
			$em->flush();

			return $this->redirectToRoute('matchcommentary_edit', array('id' => $matchCommentary->getId()));
		}

		return $this->render('SportClubBundle:MatchCommentary:edit.html.twig', array(
			'matchCommentary' => $matchCommentary,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a MatchCommentary entity.
	 *
	 * @Route("/{id}", name="matchcommentary_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, MatchCommentary $matchCommentary)
	{
		$form = $this->createDeleteForm($matchCommentary);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($matchCommentary);
			$em->flush();
		}

		return $this->redirectToRoute('matchcommentary_index');
	}

	/**
	 * Creates a form to delete a MatchCommentary entity.
	 *
	 * @param MatchCommentary $matchCommentary The MatchCommentary entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(MatchCommentary $matchCommentary)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('matchcommentary_delete', array('id' => $matchCommentary->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
