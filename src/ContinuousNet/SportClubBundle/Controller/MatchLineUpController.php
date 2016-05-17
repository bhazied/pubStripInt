<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\MatchLineUp;
use ContinuousNet\SportClubBundle\Form\MatchLineUpType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Match Line Up Controller
 * 
 * Manage MatchLineUps 
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
 * @see		MatchLineUpController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/matchlineup")
 */
class MatchLineUpController extends BaseController
{
	/**
	 * Lists all MatchLineUp entities.
	 *
	 * @Route("/", name="matchlineup_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$matchLineUps = $em->getRepository('SportClubBundle:MatchLineUp')->findAll();

		return $this->render('SportClubBundle:MatchLineUp:index.html.twig', array(
			'matchLineUps' => $matchLineUps,
		));
	}

	/**
	 * Creates a new MatchLineUp entity.
	 *
	 * @Route("/new", name="matchlineup_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$matchLineUp = new MatchLineUp();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\MatchLineUpType', $matchLineUp);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($matchLineUp);
			$em->flush();

			return $this->redirectToRoute('matchlineup_show', array('id' => $matchLineUp->getId()));
		}

		return $this->render('SportClubBundle:MatchLineUp:new.html.twig', array(
			'matchLineUp' => $matchLineUp,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a MatchLineUp entity.
	 *
	 * @Route("/{id}", name="matchlineup_show")
	 * @Method("GET")
	 */
	public function showAction(MatchLineUp $matchLineUp)
	{
		$deleteForm = $this->createDeleteForm($matchLineUp);

		return $this->render('SportClubBundle:MatchLineUp:show.html.twig', array(
			'matchLineUp' => $matchLineUp,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing MatchLineUp entity.
	 *
	 * @Route("/{id}/edit", name="matchlineup_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, MatchLineUp $matchLineUp)
	{
		$deleteForm = $this->createDeleteForm($matchLineUp);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\MatchLineUpType', $matchLineUp);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($matchLineUp);
			$em->flush();

			return $this->redirectToRoute('matchlineup_edit', array('id' => $matchLineUp->getId()));
		}

		return $this->render('SportClubBundle:MatchLineUp:edit.html.twig', array(
			'matchLineUp' => $matchLineUp,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a MatchLineUp entity.
	 *
	 * @Route("/{id}", name="matchlineup_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, MatchLineUp $matchLineUp)
	{
		$form = $this->createDeleteForm($matchLineUp);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($matchLineUp);
			$em->flush();
		}

		return $this->redirectToRoute('matchlineup_index');
	}

	/**
	 * Creates a form to delete a MatchLineUp entity.
	 *
	 * @param MatchLineUp $matchLineUp The MatchLineUp entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(MatchLineUp $matchLineUp)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('matchlineup_delete', array('id' => $matchLineUp->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
