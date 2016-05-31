<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\AudioType;
use ContinuousNet\SportClubBundle\Form\AudioTypeType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Audio Type Controller
 * 
 * Manage AudioTypes 
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
 * @see		AudioTypeController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/audiotype")
 */
class AudioTypeController extends BaseController
{
	/**
	 * Lists all AudioType entities.
	 *
	 * @Route("/", name="audiotype_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$audioTypes = $em->getRepository('SportClubBundle:AudioType')->findAll();

		return $this->render('SportClubBundle:AudioType:index.html.twig', array(
			'audioTypes' => $audioTypes,
		));
	}

	/**
	 * Creates a new AudioType entity.
	 *
	 * @Route("/new", name="audiotype_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$audioType = new AudioType();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\AudioTypeType', $audioType);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($audioType);
			$em->flush();

			return $this->redirectToRoute('audiotype_show', array('id' => $audioType->getId()));
		}

		return $this->render('SportClubBundle:AudioType:new.html.twig', array(
			'audioType' => $audioType,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a AudioType entity.
	 *
	 * @Route("/{id}", name="audiotype_show")
	 * @Method("GET")
	 */
	public function showAction(AudioType $audioType)
	{
		$deleteForm = $this->createDeleteForm($audioType);

		return $this->render('SportClubBundle:AudioType:show.html.twig', array(
			'audioType' => $audioType,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing AudioType entity.
	 *
	 * @Route("/{id}/edit", name="audiotype_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, AudioType $audioType)
	{
		$deleteForm = $this->createDeleteForm($audioType);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\AudioTypeType', $audioType);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($audioType);
			$em->flush();

			return $this->redirectToRoute('audiotype_edit', array('id' => $audioType->getId()));
		}

		return $this->render('SportClubBundle:AudioType:edit.html.twig', array(
			'audioType' => $audioType,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a AudioType entity.
	 *
	 * @Route("/{id}", name="audiotype_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, AudioType $audioType)
	{
		$form = $this->createDeleteForm($audioType);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($audioType);
			$em->flush();
		}

		return $this->redirectToRoute('audiotype_index');
	}

	/**
	 * Creates a form to delete a AudioType entity.
	 *
	 * @param AudioType $audioType The AudioType entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(AudioType $audioType)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('audiotype_delete', array('id' => $audioType->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
