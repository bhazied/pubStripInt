<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\MatchGoal;
use ContinuousNet\SportClubBundle\Form\MatchGoalType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Match Goal Controller
 * 
 * Manage MatchGoals 
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
 * @see		MatchGoalController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/matchgoal")
 */
class MatchGoalController extends BaseController
{
	/**
	 * Lists all MatchGoal entities.
	 *
	 * @Route("/", name="matchgoal_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$matchGoals = $em->getRepository('SportClubBundle:MatchGoal')->findAll();

		return $this->render('SportClubBundle:MatchGoal:index.html.twig', array(
			'matchGoals' => $matchGoals,
		));
	}

	/**
	 * Creates a new MatchGoal entity.
	 *
	 * @Route("/new", name="matchgoal_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$matchGoal = new MatchGoal();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\MatchGoalType', $matchGoal);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($matchGoal);
			$em->flush();

			return $this->redirectToRoute('matchgoal_show', array('id' => $matchGoal->getId()));
		}

		return $this->render('SportClubBundle:MatchGoal:new.html.twig', array(
			'matchGoal' => $matchGoal,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a MatchGoal entity.
	 *
	 * @Route("/{id}", name="matchgoal_show")
	 * @Method("GET")
	 */
	public function showAction(MatchGoal $matchGoal)
	{
		$deleteForm = $this->createDeleteForm($matchGoal);

		return $this->render('SportClubBundle:MatchGoal:show.html.twig', array(
			'matchGoal' => $matchGoal,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing MatchGoal entity.
	 *
	 * @Route("/{id}/edit", name="matchgoal_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, MatchGoal $matchGoal)
	{
		$deleteForm = $this->createDeleteForm($matchGoal);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\MatchGoalType', $matchGoal);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($matchGoal);
			$em->flush();

			return $this->redirectToRoute('matchgoal_edit', array('id' => $matchGoal->getId()));
		}

		return $this->render('SportClubBundle:MatchGoal:edit.html.twig', array(
			'matchGoal' => $matchGoal,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a MatchGoal entity.
	 *
	 * @Route("/{id}", name="matchgoal_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, MatchGoal $matchGoal)
	{
		$form = $this->createDeleteForm($matchGoal);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($matchGoal);
			$em->flush();
		}

		return $this->redirectToRoute('matchgoal_index');
	}

	/**
	 * Creates a form to delete a MatchGoal entity.
	 *
	 * @param MatchGoal $matchGoal The MatchGoal entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(MatchGoal $matchGoal)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('matchgoal_delete', array('id' => $matchGoal->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
