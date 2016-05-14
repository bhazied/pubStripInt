<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\Template;
use ContinuousNet\PubliPrBundle\Form\TemplateType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Template Controller
 * 
 * Manage Templates 
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
 * @see		TemplateController
 * @since	  Class available since Release 1.0
 * @access	 public
 * @Route("/template")
 */
class TemplateController extends BaseController
{
	/**
	 * Lists all Template entities.
	 *
	 * @Route("/", name="template_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$templates = $em->getRepository('PubliPrBundle:Template')->findAll();

		return $this->render('PubliPrBundle:Template:index.html.twig', array(
			'templates' => $templates,
		));
	}

	/**
	 * Creates a new Template entity.
	 *
	 * @Route("/new", name="template_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$template = new Template();
		$form = $this->createForm('ContinuousNet\PubliPrBundle\Form\TemplateType', $template);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($template);
			$em->flush();

			return $this->redirectToRoute('template_show', array('id' => $template->getId()));
		}

		return $this->render('PubliPrBundle:Template:new.html.twig', array(
			'template' => $template,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Template entity.
	 *
	 * @Route("/{id}", name="template_show")
	 * @Method("GET")
	 */
	public function showAction(Template $template)
	{
		$deleteForm = $this->createDeleteForm($template);

		return $this->render('PubliPrBundle:Template:show.html.twig', array(
			'template' => $template,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Template entity.
	 *
	 * @Route("/{id}/edit", name="template_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Template $template)
	{
		$deleteForm = $this->createDeleteForm($template);
		$editForm = $this->createForm('ContinuousNet\PubliPrBundle\Form\TemplateType', $template);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($template);
			$em->flush();

			return $this->redirectToRoute('template_edit', array('id' => $template->getId()));
		}

		return $this->render('PubliPrBundle:Template:edit.html.twig', array(
			'template' => $template,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Template entity.
	 *
	 * @Route("/{id}", name="template_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Template $template)
	{
		$form = $this->createDeleteForm($template);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($template);
			$em->flush();
		}

		return $this->redirectToRoute('template_index');
	}

	/**
	 * Creates a form to delete a Template entity.
	 *
	 * @param Template $template The Template entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Template $template)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('template_delete', array('id' => $template->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
