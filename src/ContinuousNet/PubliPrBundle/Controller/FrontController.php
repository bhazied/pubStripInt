<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\Newsroom;
use ContinuousNet\PubliPrBundle\Entity\PressRelease;
use ContinuousNet\PubliPrBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FrontController extends Controller
{

    /**
     * @Route("/{codeCp}", name="subdomain_free", host="free.%base_host%")
     * @ParamConverter("pressRelease", class="PubliPrBundle:PressRelease",  options={"id"="codeCp"})
     * @Template("PubliPrBundle:Default:external_show.html.twig")
     */
    public function showAction(PressRelease $pressRelease)
    {
        if(!$pressRelease){
            echo "public -  free - Access";
        }
        else{
            echo "not founs object";
        }
        die;
    }
    /**
     * @Route("/{client}/{newsroom_slug}/{pr_slug}", name="subdomain", host="client.%base_host%")
     * @ParamConverter("user", class="PubliPrBundle:User",  options={"mapping": {"client": "alias"}})
     * @ParamConverter("newsroom", class="PubliPrBundle:Newsroom",  options={"mapping": {"newsroom_slug": "slug"}})
     * @ParamConverter("pressRelease", class="PubliPrBundle:PressRelease",  options={"mapping": {"pr_slug": "slug"}})
     * @Template("PubliPrBundle:Default:external_show.html.twig")
     */
    public function showCustomerAction(User $user, Newsroom $newsroom, PressRelease $pressRelease)
    {
        try {
            if (!$user && !$newsroom && $pressRelease) {
                echo "Payed Access for subscribed customer";
            } else {
                echo "Not Found Objects";
            }
        }
        catch(NotFoundHttpException $ex){
            echo $ex->getMessage();
        }
        die;
    }
}
