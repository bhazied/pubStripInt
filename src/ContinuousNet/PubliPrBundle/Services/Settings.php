<?php
/**
 * Created by PhpStorm.
 * User: dev03
 * Date: 19/05/16
 * Time: 17:56
 */
namespace ContinuousNet\PubliPrBundle\Services;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class Settings {

    protected $entityManager;

    public function __construct(EntityManager $_entityManager){
        $this->entityManager = $_entityManager;
    }
    public function getSetting($key){
        $em =  $this->entityManager->getRepository('PubliPrBundle:Setting');
        return $em->findByKey($key);

    }
}