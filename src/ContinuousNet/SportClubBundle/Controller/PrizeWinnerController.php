<?php

namespace ContinuousNet\SportClubBundle\Controller;

use ContinuousNet\SportClubBundle\Entity\PrizeWinner;
use ContinuousNet\SportClubBundle\Form\PrizeWinnerType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Prize Winner Controller
 * 
 * Manage PrizeWinners 
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
 * @see		PrizeWinnerController
 * @since	  Class available since Release 1.0
 * @deprecated Nothing
 * @access	 public
 * @Route("/prizewinner")
 */
class PrizeWinnerController extends BaseController
{
	/**
	 * Lists all PrizeWinner entities.
	 *
	 * @Route("/", name="prizewinner_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$prizeWinners = $em->getRepository('SportClubBundle:PrizeWinner')->findAll();

		return $this->render('SportClubBundle:PrizeWinner:index.html.twig', array(
			'prizeWinners' => $prizeWinners,
		));
	}

	/**
	 * Creates a new PrizeWinner entity.
	 *
	 * @Route("/new", name="prizewinner_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$prizeWinner = new PrizeWinner();
		$form = $this->createForm('ContinuousNet\SportClubBundle\Form\PrizeWinnerType', $prizeWinner);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($prizeWinner);
			$em->flush();

			return $this->redirectToRoute('prizewinner_show', array('id' => $prizeWinner->getId()));
		}

		return $this->render('SportClubBundle:PrizeWinner:new.html.twig', array(
			'prizeWinner' => $prizeWinner,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a PrizeWinner entity.
	 *
	 * @Route("/{id}", name="prizewinner_show")
	 * @Method("GET")
	 */
	public function showAction(PrizeWinner $prizeWinner)
	{
		$deleteForm = $this->createDeleteForm($prizeWinner);

		return $this->render('SportClubBundle:PrizeWinner:show.html.twig', array(
			'prizeWinner' => $prizeWinner,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing PrizeWinner entity.
	 *
	 * @Route("/{id}/edit", name="prizewinner_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, PrizeWinner $prizeWinner)
	{
		$deleteForm = $this->createDeleteForm($prizeWinner);
		$editForm = $this->createForm('ContinuousNet\SportClubBundle\Form\PrizeWinnerType', $prizeWinner);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($prizeWinner);
			$em->flush();

			return $this->redirectToRoute('prizewinner_edit', array('id' => $prizeWinner->getId()));
		}

		return $this->render('SportClubBundle:PrizeWinner:edit.html.twig', array(
			'prizeWinner' => $prizeWinner,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a PrizeWinner entity.
	 *
	 * @Route("/{id}", name="prizewinner_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, PrizeWinner $prizeWinner)
	{
		$form = $this->createDeleteForm($prizeWinner);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($prizeWinner);
			$em->flush();
		}

		return $this->redirectToRoute('prizewinner_index');
	}

	/**
	 * Creates a form to delete a PrizeWinner entity.
	 *
	 * @param PrizeWinner $prizeWinner The PrizeWinner entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(PrizeWinner $prizeWinner)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('prizewinner_delete', array('id' => $prizeWinner->getId())))
			->setMethod('DELETE')
			->getForm()
		;
	}
}
