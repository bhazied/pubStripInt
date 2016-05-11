<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use ContinuousNet\PubliPrBundle\Entity\Contact;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

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


class ContactExporterController extends FOSRestController
{

    /**
     * @Post("/contactsExport")
     *
     * @param $request
     *
     */
    public function exportAction(Request $request) {
        try {

            $contactGroup = $request->request->get('contactGroup');
            $active = $request->request->get('active');
            $exportFirstName = $request->request->get('firstName');
            $exportLastName = $request->request->get('lastName');
            $exportEmail = $request->request->get('email');
            $exportPhone = $request->request->get('phone');

            $fields = array();

            if ($exportFirstName) {
                $fields[] = 'c_.firstName';
            }

            if ($exportLastName) {
                $fields[] = 'c_.lastName';
            }

            if ($exportEmail) {
                $fields[] = 'c_.email';
            }

            if ($exportPhone) {
                $fields[] = 'c_.phone';
            }

            $em = $this->getDoctrine()->getManager();
            $qb = $em->createQueryBuilder();
            $qb->from('PubliPrBundle:Contact', 'c_');
            $qb->select($fields);

            if (!is_null($contactGroup)) {
                $qb->andWhere('c_.contactGroup = :contactGroup')->setParameter('contactGroup', $contactGroup);
            }

            if ($active != '') {
                $qb->andWhere('c_.active = :active')->setParameter('active', ($active == '1'));
            }

            $roles = $this->getUser()->getRoles();
            if (!empty($roles)) {
                foreach ($roles as $role) {
                    if (substr_count($role, 'ACC') > 0) {
                        $qb->andWhere('c_.creatorUser = :user')->setParameter('user', $this->getUser()->getId());
                    }
                }
            }
            $qbList = clone $qb;
            $qb->select('count(c_.id)');
            $data['inlineCount'] = $qb->getQuery()->getSingleScalarResult();
            if ($exportFirstName) {
                $qbList->addOrderBy('c_.firstName', 'ASC');
            }
            if ($exportLastName) {
                $qbList->addOrderBy('c_.lastName', 'ASC');
            }
            if ($exportEmail) {
                $qbList->addOrderBy('c_.email', 'ASC');
            }
            if ($exportPhone) {
                $qbList->addOrderBy('c_.phone', 'ASC');
            }
            $qbList->select('c_');
            $qbList->groupBy('c_.id');
            $results = $qbList->getQuery()->getResult();

            if (!empty($results)) {

                $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

                $phpExcelObject->getProperties()->setCreator('publipr')
                    ->setLastModifiedBy($this->getUser()->getName())
                    ->setTitle('Publi PR contact list export')
                    ->setSubject('Publi PR Contact')
                    ->setDescription('Publi PR contact list export '.date('Y-m-d H:i:s').'.')
                    ->setKeywords('Publi PR contact list export')
                    ->setCategory('Contacts');

                $sheet = $phpExcelObject->setActiveSheetIndex(0);
                $alpha = range('A', 'Z');
                $alphaIndex = 0;
                $num = 1;

                if ($exportFirstName) {
                    $sheet->setCellValue($alpha[$alphaIndex].$num, 'First Name');
                    $alphaIndex++;
                }

                if ($exportLastName) {
                    $sheet->setCellValue($alpha[$alphaIndex].$num, 'Last Name');
                    $alphaIndex++;
                }

                if ($exportEmail) {
                    $sheet->setCellValue($alpha[$alphaIndex].$num, 'Email');
                    $alphaIndex++;
                }

                if ($exportPhone) {
                    $sheet->setCellValue($alpha[$alphaIndex].$num, 'Phone');
                    $alphaIndex++;
                }

                foreach ($results as $result) {

                    $alphaIndex = 0;
                    $num ++;

                    if ($exportFirstName) {
                        $sheet->setCellValue($alpha[$alphaIndex].$num, $result->getFirstName());
                        $alphaIndex++;
                    }

                    if ($exportLastName) {
                        $sheet->setCellValue($alpha[$alphaIndex].$num, $result->getLastName());
                        $alphaIndex++;
                    }

                    if ($exportEmail) {
                        $sheet->setCellValue($alpha[$alphaIndex].$num, $result->getEmail());
                        $alphaIndex++;
                    }

                    if ($exportPhone) {
                        $sheet->setCellValue($alpha[$alphaIndex].$num, $result->getPhone());
                        $alphaIndex++;
                    }

                }

                $phpExcelObject->getActiveSheet()->setTitle('Contacts');
                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $phpExcelObject->setActiveSheetIndex(0);

                // create the writer
                $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel2007');
                // create the response
                $response = $this->get('phpexcel')->createStreamedResponse($writer);
                // adding headers
                $dispositionHeader = $response->headers->makeDisposition(
                    ResponseHeaderBag::DISPOSITION_ATTACHMENT,
                    'contacts_'.date('YmdHis').'.xlsx'
                );
                $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                $response->headers->set('Pragma', 'public');
                $response->headers->set('Cache-Control', 'maxage=1');
                $response->headers->set('Content-Disposition', $dispositionHeader);

                return $response;

            } else {
                return FOSView::create('No data', Codes::HTTP_NO_CONTENT);
            }

        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}