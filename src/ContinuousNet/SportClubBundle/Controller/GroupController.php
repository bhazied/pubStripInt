<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Group;
use ContinuousNet\SportClubBundle\Form\GroupType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Group Controller
 * 
 * Manage Groups 
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
 * @see		GroupController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/group")
 */
class GroupController extends BaseController
{
	/**
	 * Lists all Group entities.
	 *
	 * @Route("/", name="group_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$groups = $em->getRepository('SportClubBundle:Group')->findAll();

		return $this->render('SportClubBundle:Group:index.html.twig', array(
			'groups' => $groups,
		));
	}

	/**
	 * Creates a new Group entity.
	 *
	 * @Route("/new", name="group_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$group = new Group();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\GroupType', $group);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($group);
			$em->flush();

			return $this->redirectToRoute('group_show', array('id' => $group->getId()));
		}

		return $this->render('SportClubBundle:Group:new.html.twig', array(
			'group' => $group,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Group entity.
	 *
	 * @Route("/{id}", name="group_show")
	 * @Method("GET")
	 */
	public function showAction(Group $group)
	{
		$deleteForm = $this->createDeleteForm($group);

		return $this->render('SportClubBundle:Group:show.html.twig', array(
			'group' => $group,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Group entity.
	 *
	 * @Route("/{id}/edit", name="group_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Group $group)
	{
		$deleteForm = $this->createDeleteForm($group);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\GroupType', $group);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($group);
			$em->flush();

			return $this->redirectToRoute('group_edit', array('id' => $group->getId()));
		}

		return $this->render('SportClubBundle:Group:edit.html.twig', array(
			'group' => $group,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Group entity.
	 *
	 * @Route("/{id}", name="group_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Group $group)
	{
		$form = $this->createDeleteForm($group);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($group);
			$em->flush();
		}

		return $this->redirectToRoute('group_index');
	}

	/**
	 * Creates a form to delete a Group entity.
	 *
	 * @param Group $group The Group entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Group $group)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('group_delete', array('id' => $group->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
