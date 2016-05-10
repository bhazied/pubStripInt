<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\NewsroomTemplate;
use ContinuousNet\PubliPrBundle\Form\NewsroomTemplateType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Newsroom Template Controller
 * 
 * Manage NewsroomTemplates 
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
 * @see		NewsroomTemplateController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/newsroomtemplate")
 */
class NewsroomTemplateController extends BaseController
{
	/**
	 * Lists all NewsroomTemplate entities.
	 *
	 * @Route("/", name="newsroomtemplate_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$newsroomTemplates = $em->getRepository('PubliPrBundle:NewsroomTemplate')->findAll();

		return $this->render('PubliPrBundle:NewsroomTemplate:index.html.twig', array(
			'newsroomTemplates' => $newsroomTemplates,
		));
	}

	/**
	 * Creates a new NewsroomTemplate entity.
	 *
	 * @Route("/new", name="newsroomtemplate_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$newsroomTemplate = new NewsroomTemplate();
		$form = $this->createForm('ContinuousNet\PubliPrBundle\Form\NewsroomTemplateType', $newsroomTemplate);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($newsroomTemplate);
			$em->flush();

			return $this->redirectToRoute('newsroomtemplate_show', array('id' => $newsroomTemplate->getId()));
		}

		return $this->render('PubliPrBundle:NewsroomTemplate:new.html.twig', array(
			'newsroomTemplate' => $newsroomTemplate,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a NewsroomTemplate entity.
	 *
	 * @Route("/{id}", name="newsroomtemplate_show")
	 * @Method("GET")
	 */
	public function showAction(NewsroomTemplate $newsroomTemplate)
	{
		$deleteForm = $this->createDeleteForm($newsroomTemplate);

		return $this->render('PubliPrBundle:NewsroomTemplate:show.html.twig', array(
			'newsroomTemplate' => $newsroomTemplate,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing NewsroomTemplate entity.
	 *
	 * @Route("/{id}/edit", name="newsroomtemplate_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, NewsroomTemplate $newsroomTemplate)
	{
		$deleteForm = $this->createDeleteForm($newsroomTemplate);
		$editForm = $this->createForm('ContinuousNet\PubliPrBundle\Form\NewsroomTemplateType', $newsroomTemplate);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($newsroomTemplate);
			$em->flush();

			return $this->redirectToRoute('newsroomtemplate_edit', array('id' => $newsroomTemplate->getId()));
		}

		return $this->render('PubliPrBundle:NewsroomTemplate:edit.html.twig', array(
			'newsroomTemplate' => $newsroomTemplate,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a NewsroomTemplate entity.
	 *
	 * @Route("/{id}", name="newsroomtemplate_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, NewsroomTemplate $newsroomTemplate)
	{
		$form = $this->createDeleteForm($newsroomTemplate);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($newsroomTemplate);
			$em->flush();
		}

		return $this->redirectToRoute('newsroomtemplate_index');
	}

	/**
	 * Creates a form to delete a NewsroomTemplate entity.
	 *
	 * @param NewsroomTemplate $newsroomTemplate The NewsroomTemplate entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(NewsroomTemplate $newsroomTemplate)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('newsroomtemplate_delete', array('id' => $newsroomTemplate->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
