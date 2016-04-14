<?php

namespace ContinuousNet\PubliPrBundle\EventListener;

use Doctrine\ORM\EntityManager;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationFailureEvent;
use Symfony\Component\Security\Core\User\UserInterface;
use ContinuousNet\PubliPrBundle\Entity\Session;

/**
 * JWTResponseListener
 *
 * @author Nicolas Cabot <n.cabot@lexik.fr>
 */
class JWTResponseListener
{
    
    protected $em;
    
    function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    /**
     * Add public data to the authentication response
     *
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        $user = $event->getUser();

        if (!$user instanceof UserInterface) {
            return;
        }
        
        $userRepository = $this->em->getRepository('PubliPrBundle:User');
        $user = $userRepository->findOneByEmail($user->getEmail());
        $user->setLoginCount($user->getLoginCount()+1);
        $user->setLastFailedLoginCount(0);
        $this->em->flush();
        
        $data['user'] = array(
            'email' => $user->getEmail(),
            'gender' => $user->getGender(),
            'name' => $user->getName(),
            'address' => $user->getAddress(),
            'city' => $user->getCity(),
            'phone' => $user->getPhone(),
            'country' => null,
            'picture' => $user->getPicture(),
            'type' => $user->getType(),
            'roles' => $user->getRoles()
        );

        if (!is_null($user->getCountry())) {
            $data['user']['country'] = $user->getCountry()->getId();
        }

        $event->setData($data);
    }
    
    /**
     * Add public data to the authentication response
     *
     * @param AuthenticationFailureEvent $event
     */
    public function onAuthenticationFailureResponse(AuthenticationFailureEvent $event)
    {
        $username = $event->getRequest()->get('username');
        $userRepository = $this->em->getRepository('PubliPrBundle:User');
        $user = $userRepository->findOneByUsername($username);
        if ($user) {
            $user->setFailedLoginCount($user->getFailedLoginCount()+1);
            $user->setLastFailedLogin(new \DateTime('now'));
            $user->setLastFailedLoginCount($user->getLastFailedLoginCount()+1);
            $this->em->flush();
        }
    }
}
