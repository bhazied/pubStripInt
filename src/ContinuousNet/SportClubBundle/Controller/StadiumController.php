<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Stadium;
use ContinuousNet\SportClubBundle\Form\StadiumType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Stadium Controller
 * 
 * Manage Stadia 
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
 * @see		StadiumController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/stadium")
 */
class StadiumController extends BaseController
{
	/**
	 * Lists all Stadium entities.
	 *
	 * @Route("/", name="stadium_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$stadia = $em->getRepository('SportClubBundle:Stadium')->findAll();

		return $this->render('SportClubBundle:Stadium:index.html.twig', array(
			'stadia' => $stadia,
		));
	}

	/**
	 * Creates a new Stadium entity.
	 *
	 * @Route("/new", name="stadium_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$stadium = new Stadium();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\StadiumType', $stadium);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($stadium);
			$em->flush();

			return $this->redirectToRoute('stadium_show', array('id' => $stadium->getId()));
		}

		return $this->render('SportClubBundle:Stadium:new.html.twig', array(
			'stadium' => $stadium,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Stadium entity.
	 *
	 * @Route("/{id}", name="stadium_show")
	 * @Method("GET")
	 */
	public function showAction(Stadium $stadium)
	{
		$deleteForm = $this->createDeleteForm($stadium);

		return $this->render('SportClubBundle:Stadium:show.html.twig', array(
			'stadium' => $stadium,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Stadium entity.
	 *
	 * @Route("/{id}/edit", name="stadium_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Stadium $stadium)
	{
		$deleteForm = $this->createDeleteForm($stadium);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\StadiumType', $stadium);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($stadium);
			$em->flush();

			return $this->redirectToRoute('stadium_edit', array('id' => $stadium->getId()));
		}

		return $this->render('SportClubBundle:Stadium:edit.html.twig', array(
			'stadium' => $stadium,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Stadium entity.
	 *
	 * @Route("/{id}", name="stadium_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Stadium $stadium)
	{
		$form = $this->createDeleteForm($stadium);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($stadium);
			$em->flush();
		}

		return $this->redirectToRoute('stadium_index');
	}

	/**
	 * Creates a form to delete a Stadium entity.
	 *
	 * @param Stadium $stadium The Stadium entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Stadium $stadium)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('stadium_delete', array('id' => $stadium->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
