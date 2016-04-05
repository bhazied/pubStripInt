<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\Setting;
use ContinuousNet\PubliPrBundle\Form\SettingType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Setting Controller
 * 
 * Manage Settings 
 * 
 * PHP version 5.4.4
 * 
 * @category   Symfony 2 Controller
 * @package	ContinuousNet\PubliPrBundle\Controller
 * @author	 Sahbi KHALFALLAH <sahbi.khalfallah@continuousnet.com>
 * @copyright  2016 CONTINUOUS NET
 * @license	CONTINUOUS NET REGULAR LICENSE
 * @version	Release: 1.0
 * @link	   http://publipr.continuousnet.com/ContinuousNet/PubliPrBundle/Controller
 * @see		SettingController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/setting")
 */
class SettingController extends BaseController
{
	/**
	 * Lists all Setting entities.
	 *
	 * @Route("/", name="setting_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$settings = $em->getRepository('PubliPrBundle:Setting')->findAll();

		return $this->render('PubliPrBundle:Setting:index.html.twig', array(
			'settings' => $settings,
		));
	}

	/**
	 * Creates a new Setting entity.
	 *
	 * @Route("/new", name="setting_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$setting = new Setting();
		$form = $this->createForm('ContinuousNet\PubliPrBundle\Form\SettingType', $setting);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($setting);
			$em->flush();

			return $this->redirectToRoute('setting_show', array('id' => $setting->getId()));
		}

		return $this->render('PubliPrBundle:Setting:new.html.twig', array(
			'setting' => $setting,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Setting entity.
	 *
	 * @Route("/{id}", name="setting_show")
	 * @Method("GET")
	 */
	public function showAction(Setting $setting)
	{
		$deleteForm = $this->createDeleteForm($setting);

		return $this->render('PubliPrBundle:Setting:show.html.twig', array(
			'setting' => $setting,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Setting entity.
	 *
	 * @Route("/{id}/edit", name="setting_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Setting $setting)
	{
		$deleteForm = $this->createDeleteForm($setting);
		$editForm = $this->createForm('ContinuousNet\PubliPrBundle\Form\SettingType', $setting);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($setting);
			$em->flush();

			return $this->redirectToRoute('setting_edit', array('id' => $setting->getId()));
		}

		return $this->render('PubliPrBundle:Setting:edit.html.twig', array(
			'setting' => $setting,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Setting entity.
	 *
	 * @Route("/{id}", name="setting_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Setting $setting)
	{
		$form = $this->createDeleteForm($setting);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($setting);
			$em->flush();
		}

		return $this->redirectToRoute('setting_index');
	}

	/**
	 * Creates a form to delete a Setting entity.
	 *
	 * @param Setting $setting The Setting entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Setting $setting)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('setting_delete', array('id' => $setting->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
