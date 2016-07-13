<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

/**
 * Public Controller
 *
 * Manage Api V1
 *
 * PHP version 5.4.4
 *
 * @category   Symfony 2 REST Controller
 * @package  ContinuousNet\PubliPrBundle\Controller
 * @author    Sahbi KHALFALLAH <sahbi.khalfallah@continuousnet.com>
 * @copyright  2016 CONTINUOUS NET
 * @license  CONTINUOUS NET REGULAR LICENSE
 * @version  Release: 1.0
 * @link    http://publipr.continuousnet.com/ContinuousNet/PubliPrBundle/Controller
 * @see      PublicController
 * @since      Class available since Release 1.0
 * @deprecated Nothing
 * @access    public
 */
class PublicController
{

    /**
     * @Template("PubliPrBundle:Public:newsroom.html.twig")
     */
    public function newsroomAction()
    {

    }

    /**
     * @Template("PubliPrBundle:Public:press_release.html.twig")
     */
    public function pressReleaseAction()
    {

    }
}