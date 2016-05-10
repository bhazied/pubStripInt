<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\City;
use ContinuousNet\SportClubBundle\Form\CityType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * City Controller
 * 
 * Manage Cities 
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
 * @see		CityController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/city")
 */
class CityController extends BaseController
{
	/**
	 * Lists all City entities.
	 *
	 * @Route("/", name="city_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$cities = $em->getRepository('SportClubBundle:City')->findAll();

		return $this->render('SportClubBundle:City:index.html.twig', array(
			'cities' => $cities,
		));
	}

	/**
	 * Creates a new City entity.
	 *
	 * @Route("/new", name="city_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$city = new City();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\CityType', $city);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($city);
			$em->flush();

			return $this->redirectToRoute('city_show', array('id' => $city->getId()));
		}

		return $this->render('SportClubBundle:City:new.html.twig', array(
			'city' => $city,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a City entity.
	 *
	 * @Route("/{id}", name="city_show")
	 * @Method("GET")
	 */
	public function showAction(City $city)
	{
		$deleteForm = $this->createDeleteForm($city);

		return $this->render('SportClubBundle:City:show.html.twig', array(
			'city' => $city,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing City entity.
	 *
	 * @Route("/{id}/edit", name="city_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, City $city)
	{
		$deleteForm = $this->createDeleteForm($city);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\CityType', $city);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($city);
			$em->flush();

			return $this->redirectToRoute('city_edit', array('id' => $city->getId()));
		}

		return $this->render('SportClubBundle:City:edit.html.twig', array(
			'city' => $city,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a City entity.
	 *
	 * @Route("/{id}", name="city_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, City $city)
	{
		$form = $this->createDeleteForm($city);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($city);
			$em->flush();
		}

		return $this->redirectToRoute('city_index');
	}

	/**
	 * Creates a form to delete a City entity.
	 *
	 * @param City $city The City entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(City $city)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('city_delete', array('id' => $city->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
