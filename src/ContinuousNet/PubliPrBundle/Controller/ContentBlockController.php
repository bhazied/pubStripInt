<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\ContentBlock;
use ContinuousNet\PubliPrBundle\Form\ContentBlockType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Content Block Controller
 * 
 * Manage ContentBlocks 
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
 * @see		ContentBlockController
 * @since	  Class available since Release 1.0
 * @access	 public
 * @Route("/contentblock")
 */
class ContentBlockController extends BaseController
{
	/**
	 * Lists all ContentBlock entities.
	 *
	 * @Route("/", name="contentblock_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$contentBlocks = $em->getRepository('PubliPrBundle:ContentBlock')->findAll();

		return $this->render('PubliPrBundle:ContentBlock:index.html.twig', array(
			'contentBlocks' => $contentBlocks,
		));
	}

	/**
	 * Creates a new ContentBlock entity.
	 *
	 * @Route("/new", name="contentblock_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$contentBlock = new ContentBlock();
		$form = $this->createForm('ContinuousNet\PubliPrBundle\Form\ContentBlockType', $contentBlock);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($contentBlock);
			$em->flush();

			return $this->redirectToRoute('contentblock_show', array('id' => $contentBlock->getId()));
		}

		return $this->render('PubliPrBundle:ContentBlock:new.html.twig', array(
			'contentBlock' => $contentBlock,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a ContentBlock entity.
	 *
	 * @Route("/{id}", name="contentblock_show")
	 * @Method("GET")
	 */
	public function showAction(ContentBlock $contentBlock)
	{
		$deleteForm = $this->createDeleteForm($contentBlock);

		return $this->render('PubliPrBundle:ContentBlock:show.html.twig', array(
			'contentBlock' => $contentBlock,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing ContentBlock entity.
	 *
	 * @Route("/{id}/edit", name="contentblock_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, ContentBlock $contentBlock)
	{
		$deleteForm = $this->createDeleteForm($contentBlock);
		$editForm = $this->createForm('ContinuousNet\PubliPrBundle\Form\ContentBlockType', $contentBlock);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($contentBlock);
			$em->flush();

			return $this->redirectToRoute('contentblock_edit', array('id' => $contentBlock->getId()));
		}

		return $this->render('PubliPrBundle:ContentBlock:edit.html.twig', array(
			'contentBlock' => $contentBlock,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a ContentBlock entity.
	 *
	 * @Route("/{id}", name="contentblock_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, ContentBlock $contentBlock)
	{
		$form = $this->createDeleteForm($contentBlock);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($contentBlock);
			$em->flush();
		}

		return $this->redirectToRoute('contentblock_index');
	}

	/**
	 * Creates a form to delete a ContentBlock entity.
	 *
	 * @param ContentBlock $contentBlock The ContentBlock entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(ContentBlock $contentBlock)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('contentblock_delete', array('id' => $contentBlock->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
