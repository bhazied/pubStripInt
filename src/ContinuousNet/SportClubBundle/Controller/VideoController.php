<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Video;
use ContinuousNet\SportClubBundle\Form\VideoType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Video Controller
 * 
 * Manage Videos 
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
 * @see		VideoController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/video")
 */
class VideoController extends BaseController
{
	/**
	 * Lists all Video entities.
	 *
	 * @Route("/", name="video_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$videos = $em->getRepository('SportClubBundle:Video')->findAll();

		return $this->render('SportClubBundle:Video:index.html.twig', array(
			'videos' => $videos,
		));
	}

	/**
	 * Creates a new Video entity.
	 *
	 * @Route("/new", name="video_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$video = new Video();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\VideoType', $video);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($video);
			$em->flush();

			return $this->redirectToRoute('video_show', array('id' => $video->getId()));
		}

		return $this->render('SportClubBundle:Video:new.html.twig', array(
			'video' => $video,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Video entity.
	 *
	 * @Route("/{id}", name="video_show")
	 * @Method("GET")
	 */
	public function showAction(Video $video)
	{
		$deleteForm = $this->createDeleteForm($video);

		return $this->render('SportClubBundle:Video:show.html.twig', array(
			'video' => $video,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Video entity.
	 *
	 * @Route("/{id}/edit", name="video_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Video $video)
	{
		$deleteForm = $this->createDeleteForm($video);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\VideoType', $video);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($video);
			$em->flush();

			return $this->redirectToRoute('video_edit', array('id' => $video->getId()));
		}

		return $this->render('SportClubBundle:Video:edit.html.twig', array(
			'video' => $video,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Video entity.
	 *
	 * @Route("/{id}", name="video_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Video $video)
	{
		$form = $this->createDeleteForm($video);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($video);
			$em->flush();
		}

		return $this->redirectToRoute('video_index');
	}

	/**
	 * Creates a form to delete a Video entity.
	 *
	 * @param Video $video The Video entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Video $video)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('video_delete', array('id' => $video->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
