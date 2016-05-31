<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Impression;
use ContinuousNet\SportClubBundle\Form\ImpressionType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Impression Controller
 * 
 * Manage Impressions 
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
 * @see		ImpressionController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/impression")
 */
class ImpressionController extends BaseController
{
	/**
	 * Lists all Impression entities.
	 *
	 * @Route("/", name="impression_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$impressions = $em->getRepository('SportClubBundle:Impression')->findAll();

		return $this->render('SportClubBundle:Impression:index.html.twig', array(
			'impressions' => $impressions,
		));
	}

	/**
	 * Creates a new Impression entity.
	 *
	 * @Route("/new", name="impression_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$impression = new Impression();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\ImpressionType', $impression);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($impression);
			$em->flush();

			return $this->redirectToRoute('impression_show', array('id' => $impression->getId()));
		}

		return $this->render('SportClubBundle:Impression:new.html.twig', array(
			'impression' => $impression,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Impression entity.
	 *
	 * @Route("/{id}", name="impression_show")
	 * @Method("GET")
	 */
	public function showAction(Impression $impression)
	{
		$deleteForm = $this->createDeleteForm($impression);

		return $this->render('SportClubBundle:Impression:show.html.twig', array(
			'impression' => $impression,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Impression entity.
	 *
	 * @Route("/{id}/edit", name="impression_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Impression $impression)
	{
		$deleteForm = $this->createDeleteForm($impression);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\ImpressionType', $impression);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($impression);
			$em->flush();

			return $this->redirectToRoute('impression_edit', array('id' => $impression->getId()));
		}

		return $this->render('SportClubBundle:Impression:edit.html.twig', array(
			'impression' => $impression,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Impression entity.
	 *
	 * @Route("/{id}", name="impression_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Impression $impression)
	{
		$form = $this->createDeleteForm($impression);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($impression);
			$em->flush();
		}

		return $this->redirectToRoute('impression_index');
	}

	/**
	 * Creates a form to delete a Impression entity.
	 *
	 * @param Impression $impression The Impression entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Impression $impression)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('impression_delete', array('id' => $impression->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
