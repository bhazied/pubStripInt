<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PubliPrBundle:Default:index.html.twig', array('name' => $name));
    }
}
