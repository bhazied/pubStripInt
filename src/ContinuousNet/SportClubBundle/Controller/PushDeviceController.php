<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\PushDevice;
use ContinuousNet\SportClubBundle\Form\PushDeviceType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Push Device Controller
 * 
 * Manage PushDevices 
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
 * @see		PushDeviceController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/pushdevice")
 */
class PushDeviceController extends BaseController
{
	/**
	 * Lists all PushDevice entities.
	 *
	 * @Route("/", name="pushdevice_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$pushDevices = $em->getRepository('SportClubBundle:PushDevice')->findAll();

		return $this->render('SportClubBundle:PushDevice:index.html.twig', array(
			'pushDevices' => $pushDevices,
		));
	}

	/**
	 * Creates a new PushDevice entity.
	 *
	 * @Route("/new", name="pushdevice_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$pushDevice = new PushDevice();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\PushDeviceType', $pushDevice);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($pushDevice);
			$em->flush();

			return $this->redirectToRoute('pushdevice_show', array('id' => $pushDevice->getId()));
		}

		return $this->render('SportClubBundle:PushDevice:new.html.twig', array(
			'pushDevice' => $pushDevice,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a PushDevice entity.
	 *
	 * @Route("/{id}", name="pushdevice_show")
	 * @Method("GET")
	 */
	public function showAction(PushDevice $pushDevice)
	{
		$deleteForm = $this->createDeleteForm($pushDevice);

		return $this->render('SportClubBundle:PushDevice:show.html.twig', array(
			'pushDevice' => $pushDevice,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing PushDevice entity.
	 *
	 * @Route("/{id}/edit", name="pushdevice_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, PushDevice $pushDevice)
	{
		$deleteForm = $this->createDeleteForm($pushDevice);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\PushDeviceType', $pushDevice);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($pushDevice);
			$em->flush();

			return $this->redirectToRoute('pushdevice_edit', array('id' => $pushDevice->getId()));
		}

		return $this->render('SportClubBundle:PushDevice:edit.html.twig', array(
			'pushDevice' => $pushDevice,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a PushDevice entity.
	 *
	 * @Route("/{id}", name="pushdevice_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, PushDevice $pushDevice)
	{
		$form = $this->createDeleteForm($pushDevice);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($pushDevice);
			$em->flush();
		}

		return $this->redirectToRoute('pushdevice_index');
	}

	/**
	 * Creates a form to delete a PushDevice entity.
	 *
	 * @param PushDevice $pushDevice The PushDevice entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(PushDevice $pushDevice)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('pushdevice_delete', array('id' => $pushDevice->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
