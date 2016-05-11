<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Audio;
use ContinuousNet\SportClubBundle\Form\AudioType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Audio Controller
 * 
 * Manage Audios 
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
 * @see		AudioController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/audio")
 */
class AudioController extends BaseController
{
	/**
	 * Lists all Audio entities.
	 *
	 * @Route("/", name="audio_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$audios = $em->getRepository('SportClubBundle:Audio')->findAll();

		return $this->render('SportClubBundle:Audio:index.html.twig', array(
			'audios' => $audios,
		));
	}

	/**
	 * Creates a new Audio entity.
	 *
	 * @Route("/new", name="audio_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$audio = new Audio();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\AudioType', $audio);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($audio);
			$em->flush();

			return $this->redirectToRoute('audio_show', array('id' => $audio->getId()));
		}

		return $this->render('SportClubBundle:Audio:new.html.twig', array(
			'audio' => $audio,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Audio entity.
	 *
	 * @Route("/{id}", name="audio_show")
	 * @Method("GET")
	 */
	public function showAction(Audio $audio)
	{
		$deleteForm = $this->createDeleteForm($audio);

		return $this->render('SportClubBundle:Audio:show.html.twig', array(
			'audio' => $audio,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Audio entity.
	 *
	 * @Route("/{id}/edit", name="audio_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Audio $audio)
	{
		$deleteForm = $this->createDeleteForm($audio);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\AudioType', $audio);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($audio);
			$em->flush();

			return $this->redirectToRoute('audio_edit', array('id' => $audio->getId()));
		}

		return $this->render('SportClubBundle:Audio:edit.html.twig', array(
			'audio' => $audio,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Audio entity.
	 *
	 * @Route("/{id}", name="audio_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Audio $audio)
	{
		$form = $this->createDeleteForm($audio);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($audio);
			$em->flush();
		}

		return $this->redirectToRoute('audio_index');
	}

	/**
	 * Creates a form to delete a Audio entity.
	 *
	 * @param Audio $audio The Audio entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Audio $audio)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('audio_delete', array('id' => $audio->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
