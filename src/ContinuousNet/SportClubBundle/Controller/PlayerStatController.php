<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\PlayerStat;
use ContinuousNet\SportClubBundle\Form\PlayerStatType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Player Stat Controller
 * 
 * Manage PlayerStats 
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
 * @see		PlayerStatController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/playerstat")
 */
class PlayerStatController extends BaseController
{
	/**
	 * Lists all PlayerStat entities.
	 *
	 * @Route("/", name="playerstat_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$playerStats = $em->getRepository('SportClubBundle:PlayerStat')->findAll();

		return $this->render('SportClubBundle:PlayerStat:index.html.twig', array(
			'playerStats' => $playerStats,
		));
	}

	/**
	 * Creates a new PlayerStat entity.
	 *
	 * @Route("/new", name="playerstat_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$playerStat = new PlayerStat();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\PlayerStatType', $playerStat);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($playerStat);
			$em->flush();

			return $this->redirectToRoute('playerstat_show', array('id' => $playerStat->getId()));
		}

		return $this->render('SportClubBundle:PlayerStat:new.html.twig', array(
			'playerStat' => $playerStat,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a PlayerStat entity.
	 *
	 * @Route("/{id}", name="playerstat_show")
	 * @Method("GET")
	 */
	public function showAction(PlayerStat $playerStat)
	{
		$deleteForm = $this->createDeleteForm($playerStat);

		return $this->render('SportClubBundle:PlayerStat:show.html.twig', array(
			'playerStat' => $playerStat,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing PlayerStat entity.
	 *
	 * @Route("/{id}/edit", name="playerstat_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, PlayerStat $playerStat)
	{
		$deleteForm = $this->createDeleteForm($playerStat);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\PlayerStatType', $playerStat);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($playerStat);
			$em->flush();

			return $this->redirectToRoute('playerstat_edit', array('id' => $playerStat->getId()));
		}

		return $this->render('SportClubBundle:PlayerStat:edit.html.twig', array(
			'playerStat' => $playerStat,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a PlayerStat entity.
	 *
	 * @Route("/{id}", name="playerstat_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, PlayerStat $playerStat)
	{
		$form = $this->createDeleteForm($playerStat);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($playerStat);
			$em->flush();
		}

		return $this->redirectToRoute('playerstat_index');
	}

	/**
	 * Creates a form to delete a PlayerStat entity.
	 *
	 * @param PlayerStat $playerStat The PlayerStat entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(PlayerStat $playerStat)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('playerstat_delete', array('id' => $playerStat->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
