<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\MatchSubstitution;
use ContinuousNet\SportClubBundle\Form\MatchSubstitutionType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Match Substitution Controller
 * 
 * Manage MatchSubstitutions 
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
 * @see		MatchSubstitutionController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/matchsubstitution")
 */
class MatchSubstitutionController extends BaseController
{
	/**
	 * Lists all MatchSubstitution entities.
	 *
	 * @Route("/", name="matchsubstitution_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$matchSubstitutions = $em->getRepository('SportClubBundle:MatchSubstitution')->findAll();

		return $this->render('SportClubBundle:MatchSubstitution:index.html.twig', array(
			'matchSubstitutions' => $matchSubstitutions,
		));
	}

	/**
	 * Creates a new MatchSubstitution entity.
	 *
	 * @Route("/new", name="matchsubstitution_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$matchSubstitution = new MatchSubstitution();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\MatchSubstitutionType', $matchSubstitution);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($matchSubstitution);
			$em->flush();

			return $this->redirectToRoute('matchsubstitution_show', array('id' => $matchSubstitution->getId()));
		}

		return $this->render('SportClubBundle:MatchSubstitution:new.html.twig', array(
			'matchSubstitution' => $matchSubstitution,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a MatchSubstitution entity.
	 *
	 * @Route("/{id}", name="matchsubstitution_show")
	 * @Method("GET")
	 */
	public function showAction(MatchSubstitution $matchSubstitution)
	{
		$deleteForm = $this->createDeleteForm($matchSubstitution);

		return $this->render('SportClubBundle:MatchSubstitution:show.html.twig', array(
			'matchSubstitution' => $matchSubstitution,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing MatchSubstitution entity.
	 *
	 * @Route("/{id}/edit", name="matchsubstitution_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, MatchSubstitution $matchSubstitution)
	{
		$deleteForm = $this->createDeleteForm($matchSubstitution);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\MatchSubstitutionType', $matchSubstitution);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($matchSubstitution);
			$em->flush();

			return $this->redirectToRoute('matchsubstitution_edit', array('id' => $matchSubstitution->getId()));
		}

		return $this->render('SportClubBundle:MatchSubstitution:edit.html.twig', array(
			'matchSubstitution' => $matchSubstitution,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a MatchSubstitution entity.
	 *
	 * @Route("/{id}", name="matchsubstitution_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, MatchSubstitution $matchSubstitution)
	{
		$form = $this->createDeleteForm($matchSubstitution);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($matchSubstitution);
			$em->flush();
		}

		return $this->redirectToRoute('matchsubstitution_index');
	}

	/**
	 * Creates a form to delete a MatchSubstitution entity.
	 *
	 * @param MatchSubstitution $matchSubstitution The MatchSubstitution entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(MatchSubstitution $matchSubstitution)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('matchsubstitution_delete', array('id' => $matchSubstitution->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
