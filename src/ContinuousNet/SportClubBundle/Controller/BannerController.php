<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Banner;
use ContinuousNet\SportClubBundle\Form\BannerType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Banner Controller
 * 
 * Manage Banners 
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
 * @see		BannerController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/banner")
 */
class BannerController extends BaseController
{
	/**
	 * Lists all Banner entities.
	 *
	 * @Route("/", name="banner_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$banners = $em->getRepository('SportClubBundle:Banner')->findAll();

		return $this->render('SportClubBundle:Banner:index.html.twig', array(
			'banners' => $banners,
		));
	}

	/**
	 * Creates a new Banner entity.
	 *
	 * @Route("/new", name="banner_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$banner = new Banner();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\BannerType', $banner);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($banner);
			$em->flush();

			return $this->redirectToRoute('banner_show', array('id' => $banner->getId()));
		}

		return $this->render('SportClubBundle:Banner:new.html.twig', array(
			'banner' => $banner,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Banner entity.
	 *
	 * @Route("/{id}", name="banner_show")
	 * @Method("GET")
	 */
	public function showAction(Banner $banner)
	{
		$deleteForm = $this->createDeleteForm($banner);

		return $this->render('SportClubBundle:Banner:show.html.twig', array(
			'banner' => $banner,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Banner entity.
	 *
	 * @Route("/{id}/edit", name="banner_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Banner $banner)
	{
		$deleteForm = $this->createDeleteForm($banner);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\BannerType', $banner);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($banner);
			$em->flush();

			return $this->redirectToRoute('banner_edit', array('id' => $banner->getId()));
		}

		return $this->render('SportClubBundle:Banner:edit.html.twig', array(
			'banner' => $banner,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Banner entity.
	 *
	 * @Route("/{id}", name="banner_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Banner $banner)
	{
		$form = $this->createDeleteForm($banner);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($banner);
			$em->flush();
		}

		return $this->redirectToRoute('banner_index');
	}

	/**
	 * Creates a form to delete a Banner entity.
	 *
	 * @param Banner $banner The Banner entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Banner $banner)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('banner_delete', array('id' => $banner->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
