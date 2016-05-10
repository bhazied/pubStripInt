<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Day;
use ContinuousNet\SportClubBundle\Form\DayType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Day Controller
 * 
 * Manage Days 
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
 * @see		DayController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/day")
 */
class DayController extends BaseController
{
	/**
	 * Lists all Day entities.
	 *
	 * @Route("/", name="day_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$days = $em->getRepository('SportClubBundle:Day')->findAll();

		return $this->render('SportClubBundle:Day:index.html.twig', array(
			'days' => $days,
		));
	}

	/**
	 * Creates a new Day entity.
	 *
	 * @Route("/new", name="day_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$day = new Day();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\DayType', $day);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($day);
			$em->flush();

			return $this->redirectToRoute('day_show', array('id' => $day->getId()));
		}

		return $this->render('SportClubBundle:Day:new.html.twig', array(
			'day' => $day,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Day entity.
	 *
	 * @Route("/{id}", name="day_show")
	 * @Method("GET")
	 */
	public function showAction(Day $day)
	{
		$deleteForm = $this->createDeleteForm($day);

		return $this->render('SportClubBundle:Day:show.html.twig', array(
			'day' => $day,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Day entity.
	 *
	 * @Route("/{id}/edit", name="day_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Day $day)
	{
		$deleteForm = $this->createDeleteForm($day);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\DayType', $day);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($day);
			$em->flush();

			return $this->redirectToRoute('day_edit', array('id' => $day->getId()));
		}

		return $this->render('SportClubBundle:Day:edit.html.twig', array(
			'day' => $day,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Day entity.
	 *
	 * @Route("/{id}", name="day_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Day $day)
	{
		$form = $this->createDeleteForm($day);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($day);
			$em->flush();
		}

		return $this->redirectToRoute('day_index');
	}

	/**
	 * Creates a form to delete a Day entity.
	 *
	 * @param Day $day The Day entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Day $day)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('day_delete', array('id' => $day->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
