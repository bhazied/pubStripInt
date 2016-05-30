<?php
namespace ContinuousNet\PubliPrBundle\Controller;
use ContinuousNet\PubliPrBundle\Entity\Contact;
use ContinuousNet\PubliPrBundle\Entity\Email;
use ContinuousNet\PubliPrBundle\Entity\EmailCampaign;
use ContinuousNet\PubliPrBundle\Entity\Newsroom;
use ContinuousNet\PubliPrBundle\Entity\Payment;
use ContinuousNet\PubliPrBundle\Entity\PressRelease;

use ContinuousNet\PubliPrBundle\Entity\Product;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Post;
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
use Doctrine\ORM\Query\Expr\Join;
use Hip\MandrillBundle\Message;
use Hip\MandrillBundle\Dispatcher;
use Symfony\Component\Security\Acl\Domain\DoctrineAclCache;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
use mikehaertl\wkhtmlto\Pdf;

class InvoiceRestController extends FOSRestController
{
    /**
     * @Post("/downloadInvoice")
     * @param $request
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function downloadInvoiceAction(Request $request)
    {
        try {
            $pdfUrl = $request->request->get('url') . $request->request->get('paymentId');
            $pdfFile = new Pdf();
            $pdfFile->binary = "xvfb-run wkhtmltopdf";
            $fileContent = $this->persisteInvoice($request->request->get('paymentId'));
            $pdfFile->addPage($fileContent);
            $pdfFile->send('invoice_'.$this->getUser()->getFirstName().'_'.$this->getUser()->getLastName().'.pdf');
            $response = new Response();
            $response->setContent($pdfFile);
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function persisteInvoice($paymentId)
    {
        $fileContent = "";
        try
        {
            $em = $this->getDoctrine()->getManager();
            $qb = $em->createQueryBuilder();
            $qb->from("PubliPrBundle:Payment", "pay_");
            $qb->leftJoin("ContinuousNet\PubliPrBundle\Entity\User", 'creatorUser', \Doctrine\ORM\Query\Expr\Join::WITH, 'pay_.creatorUser = creatorUser.id');
            $qb->leftJoin("ContinuousNet\PubliPrBundle\Entity\Country", "Country", \Doctrine\ORM\Query\Expr\Join::WITH, 'creatorUser.country = Country.id');
            $qb->where("pay_.id = :id")->setParameter('id', $paymentId);
            $qb->select('pay_');
            $result = $qb->getQuery()->getSingleResult();
            if(!$result){
                return false;
            }
            $templateContent = file_get_contents('invoice.html');
            $fileContent = str_replace('%product_name%', $result->getProduct()->getName(), $templateContent);
            $fileContent = str_replace('%invoice_number%', $result->getInvoiceNumber(), $fileContent);
            $fileContent = str_replace('%created_at%', $result->getCreatedAt()->format('F j, Y'), $fileContent);
            $fileContent = str_replace('%due_at%', $result->getCreatedAt()->format('F j, Y'), $fileContent);
            $fileContent = str_replace('%payment_method%', 'Stripe Api', $fileContent);
            $fileContent = str_replace('%product_name%', $result->getProduct()->getName(), $fileContent);
            $fileContent = str_replace('%description%', $result->getProduct()->getDescription(), $fileContent);
            $fileContent = str_replace('%price%', $result->getProduct()->getPrice(), $fileContent);
            $fileContent = str_replace('%total%', $result->getProduct()->getPrice(), $fileContent);
            $fileContent = str_replace('%user_name%', $result->getCreatorUser()->getFirstName() . ' ' . $result->getCreatorUser()->getLastName(), $fileContent);
            $fileContent = str_replace('%zip_code%', $result->getCreatorUser()->getZipCode(), $fileContent);
            $fileContent = str_replace('%address%', $result->getCreatorUser()->getAddress(), $fileContent);
            $fileContent = str_replace('%city%', $result->getCreatorUser()->getCity(), $fileContent);
            $fileContent = str_replace('%stripe_reference%', $result->getToken(), $fileContent);
            return $fileContent;
        }
        catch(\Exception $e)
        {
            return $e;
        }
    }

}
?>