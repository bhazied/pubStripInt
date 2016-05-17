<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Album;
use ContinuousNet\SportClubBundle\Form\AlbumType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Album Controller
 * 
 * Manage Albums 
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
 * @see		AlbumController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/album")
 */
class AlbumController extends BaseController
{
	/**
	 * Lists all Album entities.
	 *
	 * @Route("/", name="album_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$albums = $em->getRepository('SportClubBundle:Album')->findAll();

		return $this->render('SportClubBundle:Album:index.html.twig', array(
			'albums' => $albums,
		));
	}

	/**
	 * Creates a new Album entity.
	 *
	 * @Route("/new", name="album_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$album = new Album();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\AlbumType', $album);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($album);
			$em->flush();

			return $this->redirectToRoute('album_show', array('id' => $album->getId()));
		}

		return $this->render('SportClubBundle:Album:new.html.twig', array(
			'album' => $album,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Album entity.
	 *
	 * @Route("/{id}", name="album_show")
	 * @Method("GET")
	 */
	public function showAction(Album $album)
	{
		$deleteForm = $this->createDeleteForm($album);

		return $this->render('SportClubBundle:Album:show.html.twig', array(
			'album' => $album,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Album entity.
	 *
	 * @Route("/{id}/edit", name="album_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Album $album)
	{
		$deleteForm = $this->createDeleteForm($album);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\AlbumType', $album);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($album);
			$em->flush();

			return $this->redirectToRoute('album_edit', array('id' => $album->getId()));
		}

		return $this->render('SportClubBundle:Album:edit.html.twig', array(
			'album' => $album,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Album entity.
	 *
	 * @Route("/{id}", name="album_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Album $album)
	{
		$form = $this->createDeleteForm($album);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($album);
			$em->flush();
		}

		return $this->redirectToRoute('album_index');
	}

	/**
	 * Creates a form to delete a Album entity.
	 *
	 * @param Album $album The Album entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Album $album)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('album_delete', array('id' => $album->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
