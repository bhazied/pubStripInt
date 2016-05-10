<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Rating;
use ContinuousNet\SportClubBundle\Form\RatingType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Rating Controller
 * 
 * Manage Ratings 
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
 * @see		RatingController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/rating")
 */
class RatingController extends BaseController
{
	/**
	 * Lists all Rating entities.
	 *
	 * @Route("/", name="rating_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$ratings = $em->getRepository('SportClubBundle:Rating')->findAll();

		return $this->render('SportClubBundle:Rating:index.html.twig', array(
			'ratings' => $ratings,
		));
	}

	/**
	 * Creates a new Rating entity.
	 *
	 * @Route("/new", name="rating_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$rating = new Rating();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\RatingType', $rating);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($rating);
			$em->flush();

			return $this->redirectToRoute('rating_show', array('id' => $rating->getId()));
		}

		return $this->render('SportClubBundle:Rating:new.html.twig', array(
			'rating' => $rating,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Rating entity.
	 *
	 * @Route("/{id}", name="rating_show")
	 * @Method("GET")
	 */
	public function showAction(Rating $rating)
	{
		$deleteForm = $this->createDeleteForm($rating);

		return $this->render('SportClubBundle:Rating:show.html.twig', array(
			'rating' => $rating,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Rating entity.
	 *
	 * @Route("/{id}/edit", name="rating_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Rating $rating)
	{
		$deleteForm = $this->createDeleteForm($rating);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\RatingType', $rating);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($rating);
			$em->flush();

			return $this->redirectToRoute('rating_edit', array('id' => $rating->getId()));
		}

		return $this->render('SportClubBundle:Rating:edit.html.twig', array(
			'rating' => $rating,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Rating entity.
	 *
	 * @Route("/{id}", name="rating_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Rating $rating)
	{
		$form = $this->createDeleteForm($rating);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($rating);
			$em->flush();
		}

		return $this->redirectToRoute('rating_index');
	}

	/**
	 * Creates a form to delete a Rating entity.
	 *
	 * @param Rating $rating The Rating entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Rating $rating)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('rating_delete', array('id' => $rating->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
