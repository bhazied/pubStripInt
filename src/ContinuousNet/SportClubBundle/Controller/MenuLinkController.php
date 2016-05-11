<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\MenuLink;
use ContinuousNet\SportClubBundle\Form\MenuLinkType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Menu Link Controller
 * 
 * Manage MenuLinks 
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
 * @see		MenuLinkController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/menulink")
 */
class MenuLinkController extends BaseController
{
	/**
	 * Lists all MenuLink entities.
	 *
	 * @Route("/", name="menulink_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$menuLinks = $em->getRepository('SportClubBundle:MenuLink')->findAll();

		return $this->render('SportClubBundle:MenuLink:index.html.twig', array(
			'menuLinks' => $menuLinks,
		));
	}

	/**
	 * Creates a new MenuLink entity.
	 *
	 * @Route("/new", name="menulink_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$menuLink = new MenuLink();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\MenuLinkType', $menuLink);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($menuLink);
			$em->flush();

			return $this->redirectToRoute('menulink_show', array('id' => $menuLink->getId()));
		}

		return $this->render('SportClubBundle:MenuLink:new.html.twig', array(
			'menuLink' => $menuLink,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a MenuLink entity.
	 *
	 * @Route("/{id}", name="menulink_show")
	 * @Method("GET")
	 */
	public function showAction(MenuLink $menuLink)
	{
		$deleteForm = $this->createDeleteForm($menuLink);

		return $this->render('SportClubBundle:MenuLink:show.html.twig', array(
			'menuLink' => $menuLink,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing MenuLink entity.
	 *
	 * @Route("/{id}/edit", name="menulink_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, MenuLink $menuLink)
	{
		$deleteForm = $this->createDeleteForm($menuLink);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\MenuLinkType', $menuLink);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($menuLink);
			$em->flush();

			return $this->redirectToRoute('menulink_edit', array('id' => $menuLink->getId()));
		}

		return $this->render('SportClubBundle:MenuLink:edit.html.twig', array(
			'menuLink' => $menuLink,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a MenuLink entity.
	 *
	 * @Route("/{id}", name="menulink_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, MenuLink $menuLink)
	{
		$form = $this->createDeleteForm($menuLink);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($menuLink);
			$em->flush();
		}

		return $this->redirectToRoute('menulink_index');
	}

	/**
	 * Creates a form to delete a MenuLink entity.
	 *
	 * @param MenuLink $menuLink The MenuLink entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(MenuLink $menuLink)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('menulink_delete', array('id' => $menuLink->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
