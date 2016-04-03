<?php

namespace ContinuousNet\PubliPrBundle\EventListener;

use Doctrine\ORM\EntityManager;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTDecodedEvent;
use ContinuousNet\PubliPrBundle\Entity\Session;
use ContinuousNet\PubliPrBundle\Entity\Log;

/**
 * JWTDecodedListener
 *
 * @author Nicolas Cabot <n.cabot@lexik.fr>
 */
class JWTDecodedListener
{
    
    protected $em;
    protected $maxInactivityTime;
    
    function __construct(EntityManager $em, $maxInactivityTime)
    {
        $this->em = $em;
        $this->maxInactivityTime = $maxInactivityTime;
    }
    
    /**
     * @param JWTDecodedEvent $event
     *
     * @return void
     */
    public function onJWTDecoded(JWTDecodedEvent $event)
    {
        if (!($request = $event->getRequest())) {
            return;
        }

        $payload = $event->getPayload();
        $request = $event->getRequest();
        
        if (isset($payload['session'])) {
            $sessionRepository = $this->em->getRepository('PubliPrBundle:Session');
            $session = $sessionRepository->find($payload['session']);
            if (!$session->getIsValid()) {
                $event->markAsInvalid();
            } else {
                $lastTime = $session->getModifiedAt();
                if (is_null($lastTime)) {
                    $lastTime = $session->getCreatedAt();
                }
                $now = new \DateTime('now');
                $diff = $now->getTimestamp() - $lastTime->getTimestamp();
                if ($diff > $this->maxInactivityTime) {
                    $event->markAsInvalid();
                } else {
                    
                    $userRepository = $this->em->getRepository('PubliPrBundle:User');
                    $user = $userRepository->findOneByEmail($payload['email']);
                    $session->setModifierUser($user);
                    $session->setModifiedAt($now);
                    $this->em->flush();
                    
                    $log = new Log();
                    $log->setSession($session);
                    $log->setUrl($request->getPathInfo());
                    $log->setUrl($request->getPathInfo());
                    $log->setIpAddress($request->getClientIp());
                    $log->setMethod($request->getMethod());
                    $log->setUserAgent($request->headers->get('User-Agent'));
                    $log->setApplication($request->headers->get('BH-Application'));
                    $log->setCreatorUser($user);
                    $log->setCreatedAt(new \DateTime('now'));
                    $this->em->persist($log);
                    $this->em->flush();
                    
                }
            }
        } else {
            $event->markAsInvalid();
        }

        //if (!isset($payload['ip']) || $payload['ip'] !== $request->getClientIp()) {
        //    $event->markAsInvalid();
        //}
        
    }
}
