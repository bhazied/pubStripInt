<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Hip\MandrillBundle\Message;
use Hip\MandrillBundle\Dispatcher;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template("PubliPrBundle:Default:index.html.twig")
     */
    public function indexAction()
    {
    }

    /**
     * @Route("/testMail")
     */
    public function testMailAction()
    {

        $dispatsher = $this->get('hip_mandrill.dispatcher');
        $message = new Message();
        $message
            ->setFromName('zied.benhadjamor@continuousnet.com')
            ->setFromName('Zied Ben Hadj Amor')
            ->addTo('mr.bha.zied@gmail.com', 'Zied gmail')
            ->addTo('zied.benhadjamor@itipart.com', 'zied itipart')
            ->addTo('zied.benhadjamor@dotit.com.tn', 'zied dotit')
            ->setSubject('some subject')
            ->setHtml('<html><body>Zied est là et il test encore</body></html>');

        $result = $dispatsher->send($message);
        dump($result);
        return new Response('<pre>' . print_r($result, true) . '</pre>');
    }
}
