<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Hit;
use ContinuousNet\SportClubBundle\Form\HitType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Hit Controller
 * 
 * Manage Hits 
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
 * @see		HitController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/hit")
 */
class HitController extends BaseController
{
	/**
	 * Lists all Hit entities.
	 *
	 * @Route("/", name="hit_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$hits = $em->getRepository('SportClubBundle:Hit')->findAll();

		return $this->render('SportClubBundle:Hit:index.html.twig', array(
			'hits' => $hits,
		));
	}

	/**
	 * Creates a new Hit entity.
	 *
	 * @Route("/new", name="hit_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$hit = new Hit();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\HitType', $hit);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($hit);
			$em->flush();

			return $this->redirectToRoute('hit_show', array('id' => $hit->getId()));
		}

		return $this->render('SportClubBundle:Hit:new.html.twig', array(
			'hit' => $hit,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Hit entity.
	 *
	 * @Route("/{id}", name="hit_show")
	 * @Method("GET")
	 */
	public function showAction(Hit $hit)
	{
		$deleteForm = $this->createDeleteForm($hit);

		return $this->render('SportClubBundle:Hit:show.html.twig', array(
			'hit' => $hit,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Hit entity.
	 *
	 * @Route("/{id}/edit", name="hit_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Hit $hit)
	{
		$deleteForm = $this->createDeleteForm($hit);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\HitType', $hit);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($hit);
			$em->flush();

			return $this->redirectToRoute('hit_edit', array('id' => $hit->getId()));
		}

		return $this->render('SportClubBundle:Hit:edit.html.twig', array(
			'hit' => $hit,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Hit entity.
	 *
	 * @Route("/{id}", name="hit_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Hit $hit)
	{
		$form = $this->createDeleteForm($hit);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($hit);
			$em->flush();
		}

		return $this->redirectToRoute('hit_index');
	}

	/**
	 * Creates a form to delete a Hit entity.
	 *
	 * @param Hit $hit The Hit entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Hit $hit)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('hit_delete', array('id' => $hit->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
