<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Player;
use ContinuousNet\SportClubBundle\Form\PlayerType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Player Controller
 * 
 * Manage Players 
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
 * @see		PlayerController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/player")
 */
class PlayerController extends BaseController
{
	/**
	 * Lists all Player entities.
	 *
	 * @Route("/", name="player_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$players = $em->getRepository('SportClubBundle:Player')->findAll();

		return $this->render('SportClubBundle:Player:index.html.twig', array(
			'players' => $players,
		));
	}

	/**
	 * Creates a new Player entity.
	 *
	 * @Route("/new", name="player_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$player = new Player();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\PlayerType', $player);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($player);
			$em->flush();

			return $this->redirectToRoute('player_show', array('id' => $player->getId()));
		}

		return $this->render('SportClubBundle:Player:new.html.twig', array(
			'player' => $player,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Player entity.
	 *
	 * @Route("/{id}", name="player_show")
	 * @Method("GET")
	 */
	public function showAction(Player $player)
	{
		$deleteForm = $this->createDeleteForm($player);

		return $this->render('SportClubBundle:Player:show.html.twig', array(
			'player' => $player,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Player entity.
	 *
	 * @Route("/{id}/edit", name="player_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Player $player)
	{
		$deleteForm = $this->createDeleteForm($player);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\PlayerType', $player);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($player);
			$em->flush();

			return $this->redirectToRoute('player_edit', array('id' => $player->getId()));
		}

		return $this->render('SportClubBundle:Player:edit.html.twig', array(
			'player' => $player,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Player entity.
	 *
	 * @Route("/{id}", name="player_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Player $player)
	{
		$form = $this->createDeleteForm($player);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($player);
			$em->flush();
		}

		return $this->redirectToRoute('player_index');
	}

	/**
	 * Creates a form to delete a Player entity.
	 *
	 * @param Player $player The Player entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Player $player)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('player_delete', array('id' => $player->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
