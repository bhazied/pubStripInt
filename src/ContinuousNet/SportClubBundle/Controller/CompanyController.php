<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Company;
use ContinuousNet\SportClubBundle\Form\CompanyType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Company Controller
 * 
 * Manage Companies 
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
 * @see		CompanyController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/company")
 */
class CompanyController extends BaseController
{
	/**
	 * Lists all Company entities.
	 *
	 * @Route("/", name="company_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$companies = $em->getRepository('SportClubBundle:Company')->findAll();

		return $this->render('SportClubBundle:Company:index.html.twig', array(
			'companies' => $companies,
		));
	}

	/**
	 * Creates a new Company entity.
	 *
	 * @Route("/new", name="company_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$company = new Company();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\CompanyType', $company);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($company);
			$em->flush();

			return $this->redirectToRoute('company_show', array('id' => $company->getId()));
		}

		return $this->render('SportClubBundle:Company:new.html.twig', array(
			'company' => $company,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Company entity.
	 *
	 * @Route("/{id}", name="company_show")
	 * @Method("GET")
	 */
	public function showAction(Company $company)
	{
		$deleteForm = $this->createDeleteForm($company);

		return $this->render('SportClubBundle:Company:show.html.twig', array(
			'company' => $company,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Company entity.
	 *
	 * @Route("/{id}/edit", name="company_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Company $company)
	{
		$deleteForm = $this->createDeleteForm($company);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\CompanyType', $company);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($company);
			$em->flush();

			return $this->redirectToRoute('company_edit', array('id' => $company->getId()));
		}

		return $this->render('SportClubBundle:Company:edit.html.twig', array(
			'company' => $company,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Company entity.
	 *
	 * @Route("/{id}", name="company_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Company $company)
	{
		$form = $this->createDeleteForm($company);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($company);
			$em->flush();
		}

		return $this->redirectToRoute('company_index');
	}

	/**
	 * Creates a form to delete a Company entity.
	 *
	 * @param Company $company The Company entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Company $company)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('company_delete', array('id' => $company->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
