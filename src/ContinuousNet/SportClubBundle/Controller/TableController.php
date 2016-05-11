<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Table;
use ContinuousNet\SportClubBundle\Form\TableType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Table Controller
 * 
 * Manage Tables 
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
 * @see		TableController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/table")
 */
class TableController extends BaseController
{
	/**
	 * Lists all Table entities.
	 *
	 * @Route("/", name="table_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$tables = $em->getRepository('SportClubBundle:Table')->findAll();

		return $this->render('SportClubBundle:Table:index.html.twig', array(
			'tables' => $tables,
		));
	}

	/**
	 * Creates a new Table entity.
	 *
	 * @Route("/new", name="table_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$table = new Table();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\TableType', $table);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($table);
			$em->flush();

			return $this->redirectToRoute('table_show', array('id' => $table->getId()));
		}

		return $this->render('SportClubBundle:Table:new.html.twig', array(
			'table' => $table,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Table entity.
	 *
	 * @Route("/{id}", name="table_show")
	 * @Method("GET")
	 */
	public function showAction(Table $table)
	{
		$deleteForm = $this->createDeleteForm($table);

		return $this->render('SportClubBundle:Table:show.html.twig', array(
			'table' => $table,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Table entity.
	 *
	 * @Route("/{id}/edit", name="table_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Table $table)
	{
		$deleteForm = $this->createDeleteForm($table);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\TableType', $table);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($table);
			$em->flush();

			return $this->redirectToRoute('table_edit', array('id' => $table->getId()));
		}

		return $this->render('SportClubBundle:Table:edit.html.twig', array(
			'table' => $table,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Table entity.
	 *
	 * @Route("/{id}", name="table_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Table $table)
	{
		$form = $this->createDeleteForm($table);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($table);
			$em->flush();
		}

		return $this->redirectToRoute('table_index');
	}

	/**
	 * Creates a form to delete a Table entity.
	 *
	 * @param Table $table The Table entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Table $table)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('table_delete', array('id' => $table->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
