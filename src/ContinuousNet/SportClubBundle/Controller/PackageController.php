<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Package;
use ContinuousNet\SportClubBundle\Form\PackageType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Package Controller
 * 
 * Manage Packages 
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
 * @see		PackageController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/package")
 */
class PackageController extends BaseController
{
	/**
	 * Lists all Package entities.
	 *
	 * @Route("/", name="package_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$packages = $em->getRepository('SportClubBundle:Package')->findAll();

		return $this->render('SportClubBundle:Package:index.html.twig', array(
			'packages' => $packages,
		));
	}

	/**
	 * Creates a new Package entity.
	 *
	 * @Route("/new", name="package_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$package = new Package();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\PackageType', $package);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($package);
			$em->flush();

			return $this->redirectToRoute('package_show', array('id' => $package->getId()));
		}

		return $this->render('SportClubBundle:Package:new.html.twig', array(
			'package' => $package,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Package entity.
	 *
	 * @Route("/{id}", name="package_show")
	 * @Method("GET")
	 */
	public function showAction(Package $package)
	{
		$deleteForm = $this->createDeleteForm($package);

		return $this->render('SportClubBundle:Package:show.html.twig', array(
			'package' => $package,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Package entity.
	 *
	 * @Route("/{id}/edit", name="package_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Package $package)
	{
		$deleteForm = $this->createDeleteForm($package);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\PackageType', $package);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($package);
			$em->flush();

			return $this->redirectToRoute('package_edit', array('id' => $package->getId()));
		}

		return $this->render('SportClubBundle:Package:edit.html.twig', array(
			'package' => $package,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Package entity.
	 *
	 * @Route("/{id}", name="package_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Package $package)
	{
		$form = $this->createDeleteForm($package);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($package);
			$em->flush();
		}

		return $this->redirectToRoute('package_index');
	}

	/**
	 * Creates a form to delete a Package entity.
	 *
	 * @param Package $package The Package entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Package $package)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('package_delete', array('id' => $package->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
