<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\Stat;
use ContinuousNet\SportClubBundle\Form\StatType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Stat Controller
 * 
 * Manage Stats 
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
 * @see		StatController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/stat")
 */
class StatController extends BaseController
{
	/**
	 * Lists all Stat entities.
	 *
	 * @Route("/", name="stat_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$stats = $em->getRepository('SportClubBundle:Stat')->findAll();

		return $this->render('SportClubBundle:Stat:index.html.twig', array(
			'stats' => $stats,
		));
	}

	/**
	 * Creates a new Stat entity.
	 *
	 * @Route("/new", name="stat_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$stat = new Stat();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\StatType', $stat);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($stat);
			$em->flush();

			return $this->redirectToRoute('stat_show', array('id' => $stat->getId()));
		}

		return $this->render('SportClubBundle:Stat:new.html.twig', array(
			'stat' => $stat,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Stat entity.
	 *
	 * @Route("/{id}", name="stat_show")
	 * @Method("GET")
	 */
	public function showAction(Stat $stat)
	{
		$deleteForm = $this->createDeleteForm($stat);

		return $this->render('SportClubBundle:Stat:show.html.twig', array(
			'stat' => $stat,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Stat entity.
	 *
	 * @Route("/{id}/edit", name="stat_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Stat $stat)
	{
		$deleteForm = $this->createDeleteForm($stat);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\StatType', $stat);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($stat);
			$em->flush();

			return $this->redirectToRoute('stat_edit', array('id' => $stat->getId()));
		}

		return $this->render('SportClubBundle:Stat:edit.html.twig', array(
			'stat' => $stat,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Stat entity.
	 *
	 * @Route("/{id}", name="stat_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Stat $stat)
	{
		$form = $this->createDeleteForm($stat);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($stat);
			$em->flush();
		}

		return $this->redirectToRoute('stat_index');
	}

	/**
	 * Creates a form to delete a Stat entity.
	 *
	 * @param Stat $stat The Stat entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Stat $stat)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('stat_delete', array('id' => $stat->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
