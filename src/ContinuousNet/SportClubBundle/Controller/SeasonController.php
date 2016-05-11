<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Season;
use ContinuousNet\SportClubBundle\Form\SeasonType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Season Controller
 * 
 * Manage Seasons 
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
 * @see		SeasonController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/season")
 */
class SeasonController extends BaseController
{
	/**
	 * Lists all Season entities.
	 *
	 * @Route("/", name="season_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$seasons = $em->getRepository('SportClubBundle:Season')->findAll();

		return $this->render('SportClubBundle:Season:index.html.twig', array(
			'seasons' => $seasons,
		));
	}

	/**
	 * Creates a new Season entity.
	 *
	 * @Route("/new", name="season_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$season = new Season();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\SeasonType', $season);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($season);
			$em->flush();

			return $this->redirectToRoute('season_show', array('id' => $season->getId()));
		}

		return $this->render('SportClubBundle:Season:new.html.twig', array(
			'season' => $season,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Season entity.
	 *
	 * @Route("/{id}", name="season_show")
	 * @Method("GET")
	 */
	public function showAction(Season $season)
	{
		$deleteForm = $this->createDeleteForm($season);

		return $this->render('SportClubBundle:Season:show.html.twig', array(
			'season' => $season,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Season entity.
	 *
	 * @Route("/{id}/edit", name="season_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Season $season)
	{
		$deleteForm = $this->createDeleteForm($season);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\SeasonType', $season);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($season);
			$em->flush();

			return $this->redirectToRoute('season_edit', array('id' => $season->getId()));
		}

		return $this->render('SportClubBundle:Season:edit.html.twig', array(
			'season' => $season,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Season entity.
	 *
	 * @Route("/{id}", name="season_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Season $season)
	{
		$form = $this->createDeleteForm($season);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($season);
			$em->flush();
		}

		return $this->redirectToRoute('season_index');
	}

	/**
	 * Creates a form to delete a Season entity.
	 *
	 * @param Season $season The Season entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Season $season)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('season_delete', array('id' => $season->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
