<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\TrackPressRelease;
use ContinuousNet\PubliPrBundle\Form\TrackPressReleaseType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Track Press Release Controller
 * 
 * Manage TrackPressReleases 
 * 
 * PHP version 5.4.4
 * 
 * @category   Symfony 2 Controller
 * @package	ContinuousNet\PubliPrBundle\Controller
 * @author	 Sahbi KHALFALLAH <sahbi.khalfallah@continuousnet.com>
 * @copyright  2016 CONTINUOUS NET
 * @license	CONTINUOUS NET REGULAR LICENSE
 * @version	Release: 1.0
 * @link	   http://publipr.continuousnet.com/ContinuousNet/PubliPrBundle/Controller
 * @see		TrackPressReleaseController
 * @since	  Class available since Release 1.0
 * @access	 public
 * @Route("/trackpressrelease")
 */
class TrackPressReleaseController extends BaseController
{
	/**
	 * Lists all TrackPressRelease entities.
	 *
	 * @Route("/", name="trackpressrelease_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$trackPressReleases = $em->getRepository('PubliPrBundle:TrackPressRelease')->findAll();

		return $this->render('PubliPrBundle:TrackPressRelease:index.html.twig', array(
			'trackPressReleases' => $trackPressReleases,
		));
	}

	/**
	 * Creates a new TrackPressRelease entity.
	 *
	 * @Route("/new", name="trackpressrelease_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$trackPressRelease = new TrackPressRelease();
		$form = $this->createForm('ContinuousNet\PubliPrBundle\Form\TrackPressReleaseType', $trackPressRelease);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($trackPressRelease);
			$em->flush();

			return $this->redirectToRoute('trackpressrelease_show', array('id' => $trackPressRelease->getId()));
		}

		return $this->render('PubliPrBundle:TrackPressRelease:new.html.twig', array(
			'trackPressRelease' => $trackPressRelease,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a TrackPressRelease entity.
	 *
	 * @Route("/{id}", name="trackpressrelease_show")
	 * @Method("GET")
	 */
	public function showAction(TrackPressRelease $trackPressRelease)
	{
		$deleteForm = $this->createDeleteForm($trackPressRelease);

		return $this->render('PubliPrBundle:TrackPressRelease:show.html.twig', array(
			'trackPressRelease' => $trackPressRelease,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing TrackPressRelease entity.
	 *
	 * @Route("/{id}/edit", name="trackpressrelease_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, TrackPressRelease $trackPressRelease)
	{
		$deleteForm = $this->createDeleteForm($trackPressRelease);
		$editForm = $this->createForm('ContinuousNet\PubliPrBundle\Form\TrackPressReleaseType', $trackPressRelease);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($trackPressRelease);
			$em->flush();

			return $this->redirectToRoute('trackpressrelease_edit', array('id' => $trackPressRelease->getId()));
		}

		return $this->render('PubliPrBundle:TrackPressRelease:edit.html.twig', array(
			'trackPressRelease' => $trackPressRelease,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a TrackPressRelease entity.
	 *
	 * @Route("/{id}", name="trackpressrelease_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, TrackPressRelease $trackPressRelease)
	{
		$form = $this->createDeleteForm($trackPressRelease);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($trackPressRelease);
			$em->flush();
		}

		return $this->redirectToRoute('trackpressrelease_index');
	}

	/**
	 * Creates a form to delete a TrackPressRelease entity.
	 *
	 * @param TrackPressRelease $trackPressRelease The TrackPressRelease entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(TrackPressRelease $trackPressRelease)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('trackpressrelease_delete', array('id' => $trackPressRelease->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
