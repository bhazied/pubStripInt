<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\Language;
use ContinuousNet\PubliPrBundle\Form\LanguageType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Language Controller
 * 
 * Manage Languages 
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
 * @see		LanguageController
 * @since	  Class available since Release 1.0
 * @access	 public
 * @Route("/language")
 */
class LanguageController extends BaseController
{
	/**
	 * Lists all Language entities.
	 *
	 * @Route("/", name="language_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$languages = $em->getRepository('PubliPrBundle:Language')->findAll();

		return $this->render('PubliPrBundle:Language:index.html.twig', array(
			'languages' => $languages,
		));
	}

	/**
	 * Creates a new Language entity.
	 *
	 * @Route("/new", name="language_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$language = new Language();
		$form = $this->createForm('ContinuousNet\PubliPrBundle\Form\LanguageType', $language);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($language);
			$em->flush();

			return $this->redirectToRoute('language_show', array('id' => $language->getId()));
		}

		return $this->render('PubliPrBundle:Language:new.html.twig', array(
			'language' => $language,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a Language entity.
	 *
	 * @Route("/{id}", name="language_show")
	 * @Method("GET")
	 */
	public function showAction(Language $language)
	{
		$deleteForm = $this->createDeleteForm($language);

		return $this->render('PubliPrBundle:Language:show.html.twig', array(
			'language' => $language,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Language entity.
	 *
	 * @Route("/{id}/edit", name="language_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Language $language)
	{
		$deleteForm = $this->createDeleteForm($language);
		$editForm = $this->createForm('ContinuousNet\PubliPrBundle\Form\LanguageType', $language);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($language);
			$em->flush();

			return $this->redirectToRoute('language_edit', array('id' => $language->getId()));
		}

		return $this->render('PubliPrBundle:Language:edit.html.twig', array(
			'language' => $language,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Language entity.
	 *
	 * @Route("/{id}", name="language_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Language $language)
	{
		$form = $this->createDeleteForm($language);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($language);
			$em->flush();
		}

		return $this->redirectToRoute('language_index');
	}

	/**
	 * Creates a form to delete a Language entity.
	 *
	 * @param Language $language The Language entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Language $language)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('language_delete', array('id' => $language->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
