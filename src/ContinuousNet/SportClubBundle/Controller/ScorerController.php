<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Scorer;
use ContinuousNet\SportClubBundle\Form\ScorerType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Scorer Controller
 * 
 * Manage Scorers 
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
 * @see		ScorerController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/scorer")
 */
class ScorerController extends BaseController
{
	/**
	 * Lists all Scorer entities.
	 *
	 * @Route("/", name="scorer_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$scorers = $em->getRepository('SportClubBundle:Scorer')->findAll();

		return $this->render('SportClubBundle:Scorer:index.html.twig', array(
			'scorers' => $scorers,
		));
	}

	/**
	 * Creates a new Scorer entity.
	 *
	 * @Route("/new", name="scorer_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$scorer = new Scorer();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\ScorerType', $scorer);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($scorer);
			$em->flush();

			return $this->redirectToRoute('scorer_show', array('id' => $scorer->getId()));
		}

		return $this->render('SportClubBundle:Scorer:new.html.twig', array(
			'scorer' => $scorer,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Scorer entity.
	 *
	 * @Route("/{id}", name="scorer_show")
	 * @Method("GET")
	 */
	public function showAction(Scorer $scorer)
	{
		$deleteForm = $this->createDeleteForm($scorer);

		return $this->render('SportClubBundle:Scorer:show.html.twig', array(
			'scorer' => $scorer,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Scorer entity.
	 *
	 * @Route("/{id}/edit", name="scorer_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Scorer $scorer)
	{
		$deleteForm = $this->createDeleteForm($scorer);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\ScorerType', $scorer);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($scorer);
			$em->flush();

			return $this->redirectToRoute('scorer_edit', array('id' => $scorer->getId()));
		}

		return $this->render('SportClubBundle:Scorer:edit.html.twig', array(
			'scorer' => $scorer,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Scorer entity.
	 *
	 * @Route("/{id}", name="scorer_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Scorer $scorer)
	{
		$form = $this->createDeleteForm($scorer);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($scorer);
			$em->flush();
		}

		return $this->redirectToRoute('scorer_index');
	}

	/**
	 * Creates a form to delete a Scorer entity.
	 *
	 * @param Scorer $scorer The Scorer entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Scorer $scorer)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('scorer_delete', array('id' => $scorer->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
