<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\UserSetting;
use ContinuousNet\SportClubBundle\Form\UserSettingType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * User Setting Controller
 * 
 * Manage UserSettings 
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
 * @see		UserSettingController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/usersetting")
 */
class UserSettingController extends BaseController
{
	/**
	 * Lists all UserSetting entities.
	 *
	 * @Route("/", name="usersetting_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$userSettings = $em->getRepository('SportClubBundle:UserSetting')->findAll();

		return $this->render('SportClubBundle:UserSetting:index.html.twig', array(
			'userSettings' => $userSettings,
		));
	}

	/**
	 * Creates a new UserSetting entity.
	 *
	 * @Route("/new", name="usersetting_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$userSetting = new UserSetting();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\UserSettingType', $userSetting);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($userSetting);
			$em->flush();

			return $this->redirectToRoute('usersetting_show', array('id' => $userSetting->getId()));
		}

		return $this->render('SportClubBundle:UserSetting:new.html.twig', array(
			'userSetting' => $userSetting,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a UserSetting entity.
	 *
	 * @Route("/{id}", name="usersetting_show")
	 * @Method("GET")
	 */
	public function showAction(UserSetting $userSetting)
	{
		$deleteForm = $this->createDeleteForm($userSetting);

		return $this->render('SportClubBundle:UserSetting:show.html.twig', array(
			'userSetting' => $userSetting,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing UserSetting entity.
	 *
	 * @Route("/{id}/edit", name="usersetting_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, UserSetting $userSetting)
	{
		$deleteForm = $this->createDeleteForm($userSetting);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\UserSettingType', $userSetting);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($userSetting);
			$em->flush();

			return $this->redirectToRoute('usersetting_edit', array('id' => $userSetting->getId()));
		}

		return $this->render('SportClubBundle:UserSetting:edit.html.twig', array(
			'userSetting' => $userSetting,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a UserSetting entity.
	 *
	 * @Route("/{id}", name="usersetting_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, UserSetting $userSetting)
	{
		$form = $this->createDeleteForm($userSetting);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($userSetting);
			$em->flush();
		}

		return $this->redirectToRoute('usersetting_index');
	}

	/**
	 * Creates a form to delete a UserSetting entity.
	 *
	 * @param UserSetting $userSetting The UserSetting entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(UserSetting $userSetting)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('usersetting_delete', array('id' => $userSetting->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
