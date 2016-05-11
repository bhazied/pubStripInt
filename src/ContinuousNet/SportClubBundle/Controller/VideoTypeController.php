<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\VideoType;
use ContinuousNet\SportClubBundle\Form\VideoTypeType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Video Type Controller
 * 
 * Manage VideoTypes 
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
 * @see		VideoTypeController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/videotype")
 */
class VideoTypeController extends BaseController
{
	/**
	 * Lists all VideoType entities.
	 *
	 * @Route("/", name="videotype_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$videoTypes = $em->getRepository('SportClubBundle:VideoType')->findAll();

		return $this->render('SportClubBundle:VideoType:index.html.twig', array(
			'videoTypes' => $videoTypes,
		));
	}

	/**
	 * Creates a new VideoType entity.
	 *
	 * @Route("/new", name="videotype_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$videoType = new VideoType();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\VideoTypeType', $videoType);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($videoType);
			$em->flush();

			return $this->redirectToRoute('videotype_show', array('id' => $videoType->getId()));
		}

		return $this->render('SportClubBundle:VideoType:new.html.twig', array(
			'videoType' => $videoType,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a VideoType entity.
	 *
	 * @Route("/{id}", name="videotype_show")
	 * @Method("GET")
	 */
	public function showAction(VideoType $videoType)
	{
		$deleteForm = $this->createDeleteForm($videoType);

		return $this->render('SportClubBundle:VideoType:show.html.twig', array(
			'videoType' => $videoType,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing VideoType entity.
	 *
	 * @Route("/{id}/edit", name="videotype_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, VideoType $videoType)
	{
		$deleteForm = $this->createDeleteForm($videoType);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\VideoTypeType', $videoType);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($videoType);
			$em->flush();

			return $this->redirectToRoute('videotype_edit', array('id' => $videoType->getId()));
		}

		return $this->render('SportClubBundle:VideoType:edit.html.twig', array(
			'videoType' => $videoType,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a VideoType entity.
	 *
	 * @Route("/{id}", name="videotype_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, VideoType $videoType)
	{
		$form = $this->createDeleteForm($videoType);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($videoType);
			$em->flush();
		}

		return $this->redirectToRoute('videotype_index');
	}

	/**
	 * Creates a form to delete a VideoType entity.
	 *
	 * @param VideoType $videoType The VideoType entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(VideoType $videoType)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('videotype_delete', array('id' => $videoType->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
