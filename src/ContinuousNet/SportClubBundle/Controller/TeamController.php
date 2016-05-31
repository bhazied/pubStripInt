<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Team;
use ContinuousNet\SportClubBundle\Form\TeamType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Team Controller
 * 
 * Manage Teams 
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
 * @see		TeamController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/team")
 */
class TeamController extends BaseController
{
	/**
	 * Lists all Team entities.
	 *
	 * @Route("/", name="team_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$teams = $em->getRepository('SportClubBundle:Team')->findAll();

		return $this->render('SportClubBundle:Team:index.html.twig', array(
			'teams' => $teams,
		));
	}

	/**
	 * Creates a new Team entity.
	 *
	 * @Route("/new", name="team_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$team = new Team();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\TeamType', $team);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($team);
			$em->flush();

			return $this->redirectToRoute('team_show', array('id' => $team->getId()));
		}

		return $this->render('SportClubBundle:Team:new.html.twig', array(
			'team' => $team,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Team entity.
	 *
	 * @Route("/{id}", name="team_show")
	 * @Method("GET")
	 */
	public function showAction(Team $team)
	{
		$deleteForm = $this->createDeleteForm($team);

		return $this->render('SportClubBundle:Team:show.html.twig', array(
			'team' => $team,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Team entity.
	 *
	 * @Route("/{id}/edit", name="team_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Team $team)
	{
		$deleteForm = $this->createDeleteForm($team);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\TeamType', $team);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($team);
			$em->flush();

			return $this->redirectToRoute('team_edit', array('id' => $team->getId()));
		}

		return $this->render('SportClubBundle:Team:edit.html.twig', array(
			'team' => $team,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Team entity.
	 *
	 * @Route("/{id}", name="team_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Team $team)
	{
		$form = $this->createDeleteForm($team);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($team);
			$em->flush();
		}

		return $this->redirectToRoute('team_index');
	}

	/**
	 * Creates a form to delete a Team entity.
	 *
	 * @param Team $team The Team entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Team $team)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('team_delete', array('id' => $team->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
