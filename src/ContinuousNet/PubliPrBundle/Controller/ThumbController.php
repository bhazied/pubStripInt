<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ThumbController extends Controller
{
    /**
     * Generate thumbnails.
     *
     * @Route("/thumb")
     * @Method("GET")
     */
    public function indexAction(Request $request) {
        $image = $request->query->get('image');
        return $this->container->get('liip_imagine.controller')->filterAction($request, $image, 'thumb');
    }

}