<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\Company;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\View\View as FOSView;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Voryx\RESTGeneratorBundle\Controller\VoryxController;

class BaseRESTController extends VoryxController
{
    public function getEntityDir($entity, $pluralize = true) {
        $dir = strtolower(join('', array_slice(explode('\\', get_class($entity)), -1)));
        if ($pluralize) {
            $lastLetter = substr($dir, -1);
            switch($lastLetter) {
                case 'y':
                    return substr($dir,0,-1).'ies';
                case 's':
                    return $dir.'es';
                default:
                    return $dir.'s';
            }
        }
        return $dir;
    }

    public function getSubDirectory($entity, $absolute = true) {
        $directory = '';
        if ($absolute) {
            $directory .= $this->get('kernel')->getRootDir() . '/../web/uploads/';
        }
        $directory .= $this->getEntityDir($entity) . '/';
        return $directory;
    }

    public function createSubDirectory($entity) {
        $directory = $this->getSubDirectory($entity);
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }
    }

    public function createSubDirectories($entities) {
        foreach ($entities as $entity) {
            $this->createSubDirectory($entity);
        }
    }

    public function getCompanySubDirectory($entity, $absolute = true) {
        $directory = '';
        if ($absolute) {
            $directory .= $this->get('kernel')->getRootDir() . '/../web/uploads/';
        }
        $company = $this->getUser()->getCompany();
        if (is_null($company)) {
            $em = $this->getDoctrine()->getManager();
            $company = new Company();
            $company->setIsActive(true);
            $company->setCreatorUser($this->getUser());
            $company->setName($this->getUser()->getEmail());
            $em->persist($company);
            $em->flush();

            $this->getUser()->setCompany($company);
            $em->flush();
        }
        $directory .= 'companies/company_'.sprintf('%05d', $company->getId()) . '/';
        $directory .= $this->getEntityDir($entity, false) . '_' . sprintf('%05d', $entity->getId()) . '/';
        return $directory;
    }

    public function createCompanySubDirectory($entity) {
        $directory = $this->getCompanySubDirectory($entity);
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }
    }

    public function createCompanySubDirectories($entities) {
        foreach ($entities as $entity) {
            $this->createCompanySubDirectory($entity);
        }
    }

}