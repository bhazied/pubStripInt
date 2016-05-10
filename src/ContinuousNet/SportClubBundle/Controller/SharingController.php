<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Sharing;
use ContinuousNet\SportClubBundle\Form\SharingType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Sharing Controller
 * 
 * Manage Sharings 
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
 * @see		SharingController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/sharing")
 */
class SharingController extends BaseController
{
	/**
	 * Lists all Sharing entities.
	 *
	 * @Route("/", name="sharing_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$sharings = $em->getRepository('SportClubBundle:Sharing')->findAll();

		return $this->render('SportClubBundle:Sharing:index.html.twig', array(
			'sharings' => $sharings,
		));
	}

	/**
	 * Creates a new Sharing entity.
	 *
	 * @Route("/new", name="sharing_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$sharing = new Sharing();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\SharingType', $sharing);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($sharing);
			$em->flush();

			return $this->redirectToRoute('sharing_show', array('id' => $sharing->getId()));
		}

		return $this->render('SportClubBundle:Sharing:new.html.twig', array(
			'sharing' => $sharing,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Sharing entity.
	 *
	 * @Route("/{id}", name="sharing_show")
	 * @Method("GET")
	 */
	public function showAction(Sharing $sharing)
	{
		$deleteForm = $this->createDeleteForm($sharing);

		return $this->render('SportClubBundle:Sharing:show.html.twig', array(
			'sharing' => $sharing,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Sharing entity.
	 *
	 * @Route("/{id}/edit", name="sharing_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Sharing $sharing)
	{
		$deleteForm = $this->createDeleteForm($sharing);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\SharingType', $sharing);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($sharing);
			$em->flush();

			return $this->redirectToRoute('sharing_edit', array('id' => $sharing->getId()));
		}

		return $this->render('SportClubBundle:Sharing:edit.html.twig', array(
			'sharing' => $sharing,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Sharing entity.
	 *
	 * @Route("/{id}", name="sharing_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Sharing $sharing)
	{
		$form = $this->createDeleteForm($sharing);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($sharing);
			$em->flush();
		}

		return $this->redirectToRoute('sharing_index');
	}

	/**
	 * Creates a form to delete a Sharing entity.
	 *
	 * @param Sharing $sharing The Sharing entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Sharing $sharing)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('sharing_delete', array('id' => $sharing->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
