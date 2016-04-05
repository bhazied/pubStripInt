<?php

namespace ContinuousNet\PubliPrBundle\EventListener;

use Doctrine\ORM\EntityManager;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use ContinuousNet\PubliPrBundle\Entity\Session;

/**
 * JWTCreatedListener
 *
 * @author Nicolas Cabot <n.cabot@lexik.fr>
 */
class JWTCreatedListener
{
    
    protected $em;
    
    function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    /**
     * @param JWTCreatedEvent $event
     *
     * @return void
     */
    public function onJWTCreated(JWTCreatedEvent $event)
    {
        if (!($request = $event->getRequest())) {
            return;
        }
        
        $payload       = $event->getData();

        $userRepository = $this->em->getRepository('PubliPrBundle:User');
        $user = $userRepository->findOneByEmail($payload['email']);
        
        $sessionRepository = $this->em->getRepository('PubliPrBundle:Session');
        $sessions = $sessionRepository->findBy(array('creatorUser' => $user->getId(), 'isValid' => true));
        foreach ($sessions as $session) {
            $session->setIsValid(false);
        }
        $this->em->flush();
        
        $session = new Session();
        $session->setIp($request->getClientIp($user));
        $session->setIsValid(true);
        $session->setUserAgent($request->headers->get('User-Agent'));
        $session->setCreatorUser($user);
        $session->setCreatedAt(new \DateTime('now'));
        $this->em->persist($session);
        $this->em->flush();
        $payload['session'] = $session->getId();
        //$payload['ip'] = $request->getClientIp();
        
        $event->setData($payload);
    }
}
