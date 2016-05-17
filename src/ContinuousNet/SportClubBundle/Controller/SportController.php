<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Sport;
use ContinuousNet\SportClubBundle\Form\SportType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Sport Controller
 * 
 * Manage Sports 
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
 * @see		SportController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/sport")
 */
class SportController extends BaseController
{
	/**
	 * Lists all Sport entities.
	 *
	 * @Route("/", name="sport_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$sports = $em->getRepository('SportClubBundle:Sport')->findAll();

		return $this->render('SportClubBundle:Sport:index.html.twig', array(
			'sports' => $sports,
		));
	}

	/**
	 * Creates a new Sport entity.
	 *
	 * @Route("/new", name="sport_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$sport = new Sport();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\SportType', $sport);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($sport);
			$em->flush();

			return $this->redirectToRoute('sport_show', array('id' => $sport->getId()));
		}

		return $this->render('SportClubBundle:Sport:new.html.twig', array(
			'sport' => $sport,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Sport entity.
	 *
	 * @Route("/{id}", name="sport_show")
	 * @Method("GET")
	 */
	public function showAction(Sport $sport)
	{
		$deleteForm = $this->createDeleteForm($sport);

		return $this->render('SportClubBundle:Sport:show.html.twig', array(
			'sport' => $sport,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Sport entity.
	 *
	 * @Route("/{id}/edit", name="sport_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Sport $sport)
	{
		$deleteForm = $this->createDeleteForm($sport);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\SportType', $sport);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($sport);
			$em->flush();

			return $this->redirectToRoute('sport_edit', array('id' => $sport->getId()));
		}

		return $this->render('SportClubBundle:Sport:edit.html.twig', array(
			'sport' => $sport,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Sport entity.
	 *
	 * @Route("/{id}", name="sport_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Sport $sport)
	{
		$form = $this->createDeleteForm($sport);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($sport);
			$em->flush();
		}

		return $this->redirectToRoute('sport_index');
	}

	/**
	 * Creates a form to delete a Sport entity.
	 *
	 * @param Sport $sport The Sport entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Sport $sport)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('sport_delete', array('id' => $sport->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
