<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Country;
use ContinuousNet\SportClubBundle\Form\CountryType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Country Controller
 * 
 * Manage Countries 
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
 * @see		CountryController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/country")
 */
class CountryController extends BaseController
{
	/**
	 * Lists all Country entities.
	 *
	 * @Route("/", name="country_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$countries = $em->getRepository('SportClubBundle:Country')->findAll();

		return $this->render('SportClubBundle:Country:index.html.twig', array(
			'countries' => $countries,
		));
	}

	/**
	 * Creates a new Country entity.
	 *
	 * @Route("/new", name="country_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$country = new Country();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\CountryType', $country);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($country);
			$em->flush();

			return $this->redirectToRoute('country_show', array('id' => $country->getId()));
		}

		return $this->render('SportClubBundle:Country:new.html.twig', array(
			'country' => $country,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Country entity.
	 *
	 * @Route("/{id}", name="country_show")
	 * @Method("GET")
	 */
	public function showAction(Country $country)
	{
		$deleteForm = $this->createDeleteForm($country);

		return $this->render('SportClubBundle:Country:show.html.twig', array(
			'country' => $country,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Country entity.
	 *
	 * @Route("/{id}/edit", name="country_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Country $country)
	{
		$deleteForm = $this->createDeleteForm($country);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\CountryType', $country);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($country);
			$em->flush();

			return $this->redirectToRoute('country_edit', array('id' => $country->getId()));
		}

		return $this->render('SportClubBundle:Country:edit.html.twig', array(
			'country' => $country,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Country entity.
	 *
	 * @Route("/{id}", name="country_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Country $country)
	{
		$form = $this->createDeleteForm($country);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($country);
			$em->flush();
		}

		return $this->redirectToRoute('country_index');
	}

	/**
	 * Creates a form to delete a Country entity.
	 *
	 * @param Country $country The Country entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Country $country)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('country_delete', array('id' => $country->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
