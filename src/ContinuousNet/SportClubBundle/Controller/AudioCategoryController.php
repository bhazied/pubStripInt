<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\AudioCategory;
use ContinuousNet\SportClubBundle\Form\AudioCategoryType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Audio Category Controller
 * 
 * Manage AudioCategories 
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
 * @see		AudioCategoryController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/audiocategory")
 */
class AudioCategoryController extends BaseController
{
	/**
	 * Lists all AudioCategory entities.
	 *
	 * @Route("/", name="audiocategory_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$audioCategories = $em->getRepository('SportClubBundle:AudioCategory')->findAll();

		return $this->render('SportClubBundle:AudioCategory:index.html.twig', array(
			'audioCategories' => $audioCategories,
		));
	}

	/**
	 * Creates a new AudioCategory entity.
	 *
	 * @Route("/new", name="audiocategory_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$audioCategory = new AudioCategory();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\AudioCategoryType', $audioCategory);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($audioCategory);
			$em->flush();

			return $this->redirectToRoute('audiocategory_show', array('id' => $audioCategory->getId()));
		}

		return $this->render('SportClubBundle:AudioCategory:new.html.twig', array(
			'audioCategory' => $audioCategory,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a AudioCategory entity.
	 *
	 * @Route("/{id}", name="audiocategory_show")
	 * @Method("GET")
	 */
	public function showAction(AudioCategory $audioCategory)
	{
		$deleteForm = $this->createDeleteForm($audioCategory);

		return $this->render('SportClubBundle:AudioCategory:show.html.twig', array(
			'audioCategory' => $audioCategory,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing AudioCategory entity.
	 *
	 * @Route("/{id}/edit", name="audiocategory_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, AudioCategory $audioCategory)
	{
		$deleteForm = $this->createDeleteForm($audioCategory);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\AudioCategoryType', $audioCategory);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($audioCategory);
			$em->flush();

			return $this->redirectToRoute('audiocategory_edit', array('id' => $audioCategory->getId()));
		}

		return $this->render('SportClubBundle:AudioCategory:edit.html.twig', array(
			'audioCategory' => $audioCategory,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a AudioCategory entity.
	 *
	 * @Route("/{id}", name="audiocategory_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, AudioCategory $audioCategory)
	{
		$form = $this->createDeleteForm($audioCategory);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($audioCategory);
			$em->flush();
		}

		return $this->redirectToRoute('audiocategory_index');
	}

	/**
	 * Creates a form to delete a AudioCategory entity.
	 *
	 * @param AudioCategory $audioCategory The AudioCategory entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(AudioCategory $audioCategory)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('audiocategory_delete', array('id' => $audioCategory->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
