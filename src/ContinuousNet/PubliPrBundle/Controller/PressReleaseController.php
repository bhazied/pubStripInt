<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\PressRelease;
use ContinuousNet\PubliPrBundle\Form\PressReleaseType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Press Release Controller
 * 
 * Manage PressReleases 
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
 * @see		PressReleaseController
 * @since	  Class available since Release 1.0
 * @access	 public
 * @Route("/pressrelease")
 */
class PressReleaseController extends BaseController
{
	/**
	 * Lists all PressRelease entities.
	 *
	 * @Route("/", name="pressrelease_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$pressReleases = $em->getRepository('PubliPrBundle:PressRelease')->findAll();

		return $this->render('PubliPrBundle:PressRelease:index.html.twig', array(
			'pressReleases' => $pressReleases,
		));
	}

	/**
	 * Creates a new PressRelease entity.
	 *
	 * @Route("/new", name="pressrelease_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$pressRelease = new PressRelease();
		$form = $this->createForm('ContinuousNet\PubliPrBundle\Form\PressReleaseType', $pressRelease);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($pressRelease);
			$em->flush();

			return $this->redirectToRoute('pressrelease_show', array('id' => $pressRelease->getId()));
		}

		return $this->render('PubliPrBundle:PressRelease:new.html.twig', array(
			'pressRelease' => $pressRelease,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a PressRelease entity.
	 *
	 * @Route("/{id}", name="pressrelease_show")
	 * @Method("GET")
	 */
	public function showAction(PressRelease $pressRelease)
	{
		$deleteForm = $this->createDeleteForm($pressRelease);

		return $this->render('PubliPrBundle:PressRelease:show.html.twig', array(
			'pressRelease' => $pressRelease,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing PressRelease entity.
	 *
	 * @Route("/{id}/edit", name="pressrelease_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, PressRelease $pressRelease)
	{
		$deleteForm = $this->createDeleteForm($pressRelease);
		$editForm = $this->createForm('ContinuousNet\PubliPrBundle\Form\PressReleaseType', $pressRelease);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($pressRelease);
			$em->flush();

			return $this->redirectToRoute('pressrelease_edit', array('id' => $pressRelease->getId()));
		}

		return $this->render('PubliPrBundle:PressRelease:edit.html.twig', array(
			'pressRelease' => $pressRelease,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a PressRelease entity.
	 *
	 * @Route("/{id}", name="pressrelease_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, PressRelease $pressRelease)
	{
		$form = $this->createDeleteForm($pressRelease);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($pressRelease);
			$em->flush();
		}

		return $this->redirectToRoute('pressrelease_index');
	}

	/**
	 * Creates a form to delete a PressRelease entity.
	 *
	 * @param PressRelease $pressRelease The PressRelease entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(PressRelease $pressRelease)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('pressrelease_delete', array('id' => $pressRelease->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
