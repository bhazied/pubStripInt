<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Menu;
use ContinuousNet\SportClubBundle\Form\MenuType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Menu Controller
 * 
 * Manage Menus 
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
 * @see		MenuController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/menu")
 */
class MenuController extends BaseController
{
	/**
	 * Lists all Menu entities.
	 *
	 * @Route("/", name="menu_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$menus = $em->getRepository('SportClubBundle:Menu')->findAll();

		return $this->render('SportClubBundle:Menu:index.html.twig', array(
			'menus' => $menus,
		));
	}

	/**
	 * Creates a new Menu entity.
	 *
	 * @Route("/new", name="menu_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$menu = new Menu();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\MenuType', $menu);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($menu);
			$em->flush();

			return $this->redirectToRoute('menu_show', array('id' => $menu->getId()));
		}

		return $this->render('SportClubBundle:Menu:new.html.twig', array(
			'menu' => $menu,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Menu entity.
	 *
	 * @Route("/{id}", name="menu_show")
	 * @Method("GET")
	 */
	public function showAction(Menu $menu)
	{
		$deleteForm = $this->createDeleteForm($menu);

		return $this->render('SportClubBundle:Menu:show.html.twig', array(
			'menu' => $menu,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Menu entity.
	 *
	 * @Route("/{id}/edit", name="menu_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Menu $menu)
	{
		$deleteForm = $this->createDeleteForm($menu);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\MenuType', $menu);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($menu);
			$em->flush();

			return $this->redirectToRoute('menu_edit', array('id' => $menu->getId()));
		}

		return $this->render('SportClubBundle:Menu:edit.html.twig', array(
			'menu' => $menu,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Menu entity.
	 *
	 * @Route("/{id}", name="menu_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Menu $menu)
	{
		$form = $this->createDeleteForm($menu);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($menu);
			$em->flush();
		}

		return $this->redirectToRoute('menu_index');
	}

	/**
	 * Creates a form to delete a Menu entity.
	 *
	 * @param Menu $menu The Menu entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Menu $menu)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('menu_delete', array('id' => $menu->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
