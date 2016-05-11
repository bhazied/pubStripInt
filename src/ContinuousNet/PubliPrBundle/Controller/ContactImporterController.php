<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\Contact;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\View\View as FOSView;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;


class ContactImporterController extends FOSRestController
{

    /**
     * @Post("/contactsImport")
     *
     * @param $request
     *
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @return Response
     */
    public function importAction(Request $request) {
        try {

            $contactGroupId = $request->request->get('contactGroup');
            $active = $request->request->get('active');

            $firstNameCol = $request->request->get('firstName');
            $lastNameCol = $request->request->get('lastName');
            $emailCol = $request->request->get('email');
            $phoneCol = $request->request->get('phone');

            $em = $this->getDoctrine()->getManager();
            $contactGroup = $em->getRepository('PubliPrBundle:ContactGroup')->find($contactGroupId);

            $exist = 0;
            $imported = 0;

            foreach($request->files as $x => $uploadedFile) {
                $originalName = strtolower($uploadedFile->getClientOriginalName());
                $info = new \SplFileInfo($originalName);
                $extension = $info->getExtension();
                if ($extension) {
                    if ($extension == 'xlsx' || $extension == 'xls') {
                        $directory = $this->get('kernel')->getRootDir() . '/../web/uploads/import/';
                        $name = $this->getUser()->getId().'_'.time().'_'.$x.'.'.$extension;
                        $file = $uploadedFile->move($directory, $name);
                        $filePath = $file->getRealPath();
                        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject($filePath);
                        $objPHPExcel = \PHPExcel_IOFactory::load($filePath);
                        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                            $rowIterator = $worksheet->getRowIterator();
                            foreach ($rowIterator as $row) {
                                $cellIterator = $row->getCellIterator();
                                $contact = new Contact();
                                $contact->setContactGroup($contactGroup);
                                $contact->setCreatorUser($this->getUser());
                                if ($active) {
                                    $contact->setActive(true);
                                } else {
                                    $contact->setActive(false);
                                }
                                $i = 0;
                                foreach ($cellIterator as $cell) {
                                    $i++;
                                    if ($i == $firstNameCol) {
                                        $contact->setFirstName($cell->getValue());
                                    }
                                    if ($i == $lastNameCol) {
                                        $contact->setLastName($cell->getValue());
                                    }
                                    if ($i == $emailCol) {
                                        $contact->setEmail($cell->getValue());
                                    }
                                    if ($i == $phoneCol) {
                                        $contact->setPhone($cell->getValue());
                                    }
                                }
                                if (!is_null($contact->getEmail())) {
                                    $emailExist = $this->emailExist($contact->getEmail(), $contactGroupId);
                                    if (!$emailExist) {
                                        $em->persist($contact);
                                        try {
                                            $em->flush();
                                            $imported++;
                                        } catch (\Exception $e) {

                                        }
                                    } else {
                                        $exist++;
                                    }
                                }
                            }
                        }
                    } else {
                        $data = array('status' => true, 'message' => $this->get('translator')->trans('contacts.not_allowed_extension'));
                        return $data;
                    }
                }
            }
            //$msg = $this->get('translator')->trans('contacts.import_success');
            $msg = '%d contacts imported, %d contacts already exist in this group';
            $message = sprintf($msg, $imported, $exist);
            $data = array('status' => true, 'message' => $message);
            return $data;

        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function emailExist($email, $contactGroup) {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->from('PubliPrBundle:Contact', 'c_');
        $qb->select('count(c_.id)');
        $qb->andWhere('c_.contactGroup = :contactGroup')->setParameter('contactGroup', $contactGroup);
        $qb->andWhere('c_.email = :email')->setParameter('email', $email);
        return ($qb->getQuery()->getSingleScalarResult() > 0);
    }

}