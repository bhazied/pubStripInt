<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\PackageType;
use ContinuousNet\SportClubBundle\Form\PackageTypeType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Package Type Controller
 * 
 * Manage PackageTypes 
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
 * @see		PackageTypeController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/packagetype")
 */
class PackageTypeController extends BaseController
{
	/**
	 * Lists all PackageType entities.
	 *
	 * @Route("/", name="packagetype_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$packageTypes = $em->getRepository('SportClubBundle:PackageType')->findAll();

		return $this->render('SportClubBundle:PackageType:index.html.twig', array(
			'packageTypes' => $packageTypes,
		));
	}

	/**
	 * Creates a new PackageType entity.
	 *
	 * @Route("/new", name="packagetype_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$packageType = new PackageType();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\PackageTypeType', $packageType);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($packageType);
			$em->flush();

			return $this->redirectToRoute('packagetype_show', array('id' => $packageType->getId()));
		}

		return $this->render('SportClubBundle:PackageType:new.html.twig', array(
			'packageType' => $packageType,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a PackageType entity.
	 *
	 * @Route("/{id}", name="packagetype_show")
	 * @Method("GET")
	 */
	public function showAction(PackageType $packageType)
	{
		$deleteForm = $this->createDeleteForm($packageType);

		return $this->render('SportClubBundle:PackageType:show.html.twig', array(
			'packageType' => $packageType,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing PackageType entity.
	 *
	 * @Route("/{id}/edit", name="packagetype_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, PackageType $packageType)
	{
		$deleteForm = $this->createDeleteForm($packageType);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\PackageTypeType', $packageType);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($packageType);
			$em->flush();

			return $this->redirectToRoute('packagetype_edit', array('id' => $packageType->getId()));
		}

		return $this->render('SportClubBundle:PackageType:edit.html.twig', array(
			'packageType' => $packageType,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a PackageType entity.
	 *
	 * @Route("/{id}", name="packagetype_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, PackageType $packageType)
	{
		$form = $this->createDeleteForm($packageType);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($packageType);
			$em->flush();
		}

		return $this->redirectToRoute('packagetype_index');
	}

	/**
	 * Creates a form to delete a PackageType entity.
	 *
	 * @param PackageType $packageType The PackageType entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(PackageType $packageType)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('packagetype_delete', array('id' => $packageType->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
