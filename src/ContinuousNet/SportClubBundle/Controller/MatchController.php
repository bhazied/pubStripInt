<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Match;
use ContinuousNet\SportClubBundle\Form\MatchType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Match Controller
 * 
 * Manage Matches 
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
 * @see		MatchController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/match")
 */
class MatchController extends BaseController
{
	/**
	 * Lists all Match entities.
	 *
	 * @Route("/", name="match_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$matches = $em->getRepository('SportClubBundle:Match')->findAll();

		return $this->render('SportClubBundle:Match:index.html.twig', array(
			'matches' => $matches,
		));
	}

	/**
	 * Creates a new Match entity.
	 *
	 * @Route("/new", name="match_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$match = new Match();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\MatchType', $match);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($match);
			$em->flush();

			return $this->redirectToRoute('match_show', array('id' => $match->getId()));
		}

		return $this->render('SportClubBundle:Match:new.html.twig', array(
			'match' => $match,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Match entity.
	 *
	 * @Route("/{id}", name="match_show")
	 * @Method("GET")
	 */
	public function showAction(Match $match)
	{
		$deleteForm = $this->createDeleteForm($match);

		return $this->render('SportClubBundle:Match:show.html.twig', array(
			'match' => $match,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Match entity.
	 *
	 * @Route("/{id}/edit", name="match_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Match $match)
	{
		$deleteForm = $this->createDeleteForm($match);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\MatchType', $match);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($match);
			$em->flush();

			return $this->redirectToRoute('match_edit', array('id' => $match->getId()));
		}

		return $this->render('SportClubBundle:Match:edit.html.twig', array(
			'match' => $match,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Match entity.
	 *
	 * @Route("/{id}", name="match_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Match $match)
	{
		$form = $this->createDeleteForm($match);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($match);
			$em->flush();
		}

		return $this->redirectToRoute('match_index');
	}

	/**
	 * Creates a form to delete a Match entity.
	 *
	 * @param Match $match The Match entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Match $match)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('match_delete', array('id' => $match->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
