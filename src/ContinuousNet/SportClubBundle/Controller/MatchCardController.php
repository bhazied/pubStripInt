<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\MatchCard;
use ContinuousNet\SportClubBundle\Form\MatchCardType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Match Card Controller
 * 
 * Manage MatchCards 
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
 * @see		MatchCardController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/matchcard")
 */
class MatchCardController extends BaseController
{
	/**
	 * Lists all MatchCard entities.
	 *
	 * @Route("/", name="matchcard_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$matchCards = $em->getRepository('SportClubBundle:MatchCard')->findAll();

		return $this->render('SportClubBundle:MatchCard:index.html.twig', array(
			'matchCards' => $matchCards,
		));
	}

	/**
	 * Creates a new MatchCard entity.
	 *
	 * @Route("/new", name="matchcard_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$matchCard = new MatchCard();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\MatchCardType', $matchCard);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($matchCard);
			$em->flush();

			return $this->redirectToRoute('matchcard_show', array('id' => $matchCard->getId()));
		}

		return $this->render('SportClubBundle:MatchCard:new.html.twig', array(
			'matchCard' => $matchCard,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a MatchCard entity.
	 *
	 * @Route("/{id}", name="matchcard_show")
	 * @Method("GET")
	 */
	public function showAction(MatchCard $matchCard)
	{
		$deleteForm = $this->createDeleteForm($matchCard);

		return $this->render('SportClubBundle:MatchCard:show.html.twig', array(
			'matchCard' => $matchCard,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing MatchCard entity.
	 *
	 * @Route("/{id}/edit", name="matchcard_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, MatchCard $matchCard)
	{
		$deleteForm = $this->createDeleteForm($matchCard);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\MatchCardType', $matchCard);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($matchCard);
			$em->flush();

			return $this->redirectToRoute('matchcard_edit', array('id' => $matchCard->getId()));
		}

		return $this->render('SportClubBundle:MatchCard:edit.html.twig', array(
			'matchCard' => $matchCard,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a MatchCard entity.
	 *
	 * @Route("/{id}", name="matchcard_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, MatchCard $matchCard)
	{
		$form = $this->createDeleteForm($matchCard);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($matchCard);
			$em->flush();
		}

		return $this->redirectToRoute('matchcard_index');
	}

	/**
	 * Creates a form to delete a MatchCard entity.
	 *
	 * @param MatchCard $matchCard The MatchCard entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(MatchCard $matchCard)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('matchcard_delete', array('id' => $matchCard->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
