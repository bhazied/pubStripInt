<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\BannerType;
use ContinuousNet\SportClubBundle\Form\BannerTypeType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Banner Type Controller
 * 
 * Manage BannerTypes 
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
 * @see		BannerTypeController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/bannertype")
 */
class BannerTypeController extends BaseController
{
	/**
	 * Lists all BannerType entities.
	 *
	 * @Route("/", name="bannertype_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$bannerTypes = $em->getRepository('SportClubBundle:BannerType')->findAll();

		return $this->render('SportClubBundle:BannerType:index.html.twig', array(
			'bannerTypes' => $bannerTypes,
		));
	}

	/**
	 * Creates a new BannerType entity.
	 *
	 * @Route("/new", name="bannertype_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$bannerType = new BannerType();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\BannerTypeType', $bannerType);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($bannerType);
			$em->flush();

			return $this->redirectToRoute('bannertype_show', array('id' => $bannerType->getId()));
		}

		return $this->render('SportClubBundle:BannerType:new.html.twig', array(
			'bannerType' => $bannerType,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a BannerType entity.
	 *
	 * @Route("/{id}", name="bannertype_show")
	 * @Method("GET")
	 */
	public function showAction(BannerType $bannerType)
	{
		$deleteForm = $this->createDeleteForm($bannerType);

		return $this->render('SportClubBundle:BannerType:show.html.twig', array(
			'bannerType' => $bannerType,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing BannerType entity.
	 *
	 * @Route("/{id}/edit", name="bannertype_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, BannerType $bannerType)
	{
		$deleteForm = $this->createDeleteForm($bannerType);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\BannerTypeType', $bannerType);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($bannerType);
			$em->flush();

			return $this->redirectToRoute('bannertype_edit', array('id' => $bannerType->getId()));
		}

		return $this->render('SportClubBundle:BannerType:edit.html.twig', array(
			'bannerType' => $bannerType,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a BannerType entity.
	 *
	 * @Route("/{id}", name="bannertype_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, BannerType $bannerType)
	{
		$form = $this->createDeleteForm($bannerType);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($bannerType);
			$em->flush();
		}

		return $this->redirectToRoute('bannertype_index');
	}

	/**
	 * Creates a form to delete a BannerType entity.
	 *
	 * @param BannerType $bannerType The BannerType entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(BannerType $bannerType)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('bannertype_delete', array('id' => $bannerType->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
