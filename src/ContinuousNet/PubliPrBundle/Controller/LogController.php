<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\Log;
use ContinuousNet\PubliPrBundle\Form\LogType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Log Controller
 * 
 * Manage Logs 
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
 * @see		LogController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/log")
 */
class LogController extends BaseController
{
	/**
	 * Lists all Log entities.
	 *
	 * @Route("/", name="log_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$logs = $em->getRepository('PubliPrBundle:Log')->findAll();

		return $this->render('PubliPrBundle:Log:index.html.twig', array(
			'logs' => $logs,
		));
	}

	/**
	 * Creates a new Log entity.
	 *
	 * @Route("/new", name="log_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$log = new Log();
		$form = $this->createForm('ContinuousNet\PubliPrBundle\Form\LogType', $log);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($log);
			$em->flush();

			return $this->redirectToRoute('log_show', array('id' => $log->getId()));
		}

		return $this->render('PubliPrBundle:Log:new.html.twig', array(
			'log' => $log,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Log entity.
	 *
	 * @Route("/{id}", name="log_show")
	 * @Method("GET")
	 */
	public function showAction(Log $log)
	{
		$deleteForm = $this->createDeleteForm($log);

		return $this->render('PubliPrBundle:Log:show.html.twig', array(
			'log' => $log,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Log entity.
	 *
	 * @Route("/{id}/edit", name="log_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Log $log)
	{
		$deleteForm = $this->createDeleteForm($log);
		$editForm = $this->createForm('ContinuousNet\PubliPrBundle\Form\LogType', $log);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($log);
			$em->flush();

			return $this->redirectToRoute('log_edit', array('id' => $log->getId()));
		}

		return $this->render('PubliPrBundle:Log:edit.html.twig', array(
			'log' => $log,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Log entity.
	 *
	 * @Route("/{id}", name="log_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Log $log)
	{
		$form = $this->createDeleteForm($log);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($log);
			$em->flush();
		}

		return $this->redirectToRoute('log_index');
	}

	/**
	 * Creates a form to delete a Log entity.
	 *
	 * @param Log $log The Log entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Log $log)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('log_delete', array('id' => $log->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
