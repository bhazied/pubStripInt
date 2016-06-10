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
            $pdfFile = new Pdf();
            $pdfFile->binary =  $this->getParameter('wkpdftohtml_binary');
            if($request->request->get('isNormal') == 1)
            {
                $fileContent = $this->persisteInvoiceFromProduct($request->request->get('paymentId'));
            }
            else
            {
                $fileContent = $this->persisteInvoiceFromRecurrent($request->request->get('paymentId'));
            }
            $pdfFile->addPage($fileContent);
            $pdfFile->send('invoice_'.$this->getUser()->getFirstName().'_'.$this->getUser()->getLastName().'.pdf');
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function persisteInvoiceFromProduct($paymentId)
    {
        $fileContent = '';
        try
        {
            $em = $this->getDoctrine()->getManager();
            $qb = $em->createQueryBuilder();
            $qb->from('PubliPrBundle:Payment', 'p_');
            $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\User', 'creatorUser', \Doctrine\ORM\Query\Expr\Join::WITH, 'p_.creatorUser = creatorUser.id');
            $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\Country', 'Country', \Doctrine\ORM\Query\Expr\Join::WITH, 'creatorUser.country = Country.id');
            $qb->where('p_.id = :id')->setParameter('id', $paymentId);
            $qb->select('p_');
            $result = $qb->getQuery()->getSingleResult();
            $price_vat = ($result->getProduct()->getPrice() * $this->container->getParameter('publipr.settings.default_vat')) / 100;
            $price = $result->getProduct()->getPrice() - $price_vat;
            $templateContent = file_get_contents('invoice.html');
            $fileContent = str_replace('%product_name%', $result->getProduct()->getName(), $templateContent);
            $fileContent = str_replace('%invoice_number%', $result->getInvoiceNumber(), $fileContent);
            $fileContent = str_replace('%created_at%', $result->getCreatedAt()->format('F j, Y'), $fileContent);
            $fileContent = str_replace('%due_at%', $result->getCreatedAt()->format('F j, Y'), $fileContent);
            $fileContent = str_replace('%payment_method%', 'Stripe Api', $fileContent);
            $fileContent = str_replace('%product_name%', $result->getProduct()->getName(), $fileContent);
            $fileContent = str_replace('%description%', $result->getProduct()->getDescription(), $fileContent);
            $fileContent = str_replace('%price%', $price, $fileContent);
            $fileContent = str_replace('%total%', $result->getProduct()->getPrice(), $fileContent);
            $fileContent = str_replace('%user_name%', $result->getCreatorUser()->getName(), $fileContent);
            $fileContent = str_replace('%zip_code%', $result->getCreatorUser()->getZipCode(), $fileContent);
            $fileContent = str_replace('%address%', $result->getCreatorUser()->getAddress(), $fileContent);
            $fileContent = str_replace('%city%', $result->getCreatorUser()->getCity(), $fileContent);
            $fileContent = str_replace('%country%', $result->getCreatorUser()->getCountry()->getName(), $fileContent);
            $fileContent = str_replace('%stripe_reference%', $result->getToken(), $fileContent);
            $fileContent = str_replace('%vat%', $this->container->getParameter('publipr.settings.default_vat'), $fileContent);
            $fileContent = str_replace('%price_vat%', $price_vat, $fileContent);
            $fileContent = str_replace('%logo%', $this->container->get('request_stack')->getCurrentRequest()->getUriForPath('/app/images/logo-dark.png'), $fileContent);
            return $fileContent;
        }
        catch(\Exception $e)
        {
            return $e;
        }
    }

    private function persisteInvoiceFromRecurrent($paymentPlanId)
    {
        $fileContent = '';
        try
        {
            $em = $this->getDoctrine()->getManager();
            $qb = $em->createQueryBuilder();
            $qb->from('PubliPrBundle:UserPaymentPlan', 'p_');
            $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\User', 'user', \Doctrine\ORM\Query\Expr\Join::WITH, 'p_.user = user.id');
            $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\Country', 'Country', \Doctrine\ORM\Query\Expr\Join::WITH, 'user.country = Country.id');
            $qb->where('p_.id = :id')->setParameter('id', $paymentPlanId);
            $qb->select('p_');
            $result = $qb->getQuery()->getSingleResult();
            $price_vat = ($result->getPaymentPlan()->getAmount() * $this->container->getParameter('publipr.settings.default_vat')) / 100;
            $price = $result->getPaymentPlan()->getAmount() - $price_vat;
            $templateContent = file_get_contents('invoice.html');
            $fileContent = str_replace('%product_name%', $result->getPaymentPlan()->getName(), $templateContent);
            $fileContent = str_replace('%invoice_number%', $result->getId().'/'.$result->getUser()->getId(), $fileContent);
            $fileContent = str_replace('%created_at%', $result->getCreatedAt()->format('F j, Y'), $fileContent);
            $fileContent = str_replace('%due_at%', $result->getCreatedAt()->format('F j, Y'), $fileContent);
            $fileContent = str_replace('%payment_method%', 'Stripe Api', $fileContent);
            $fileContent = str_replace('%product_name%', $result->getPaymentPlan()->getName(), $fileContent);
            $fileContent = str_replace('%description%', '', $fileContent);
            $fileContent = str_replace('%price%', $price, $fileContent);
            $fileContent = str_replace('%total%', $result->getPaymentPlan()->getAmount(), $fileContent);
            $fileContent = str_replace('%user_name%', $result->getUser()->getName(), $fileContent);
            $fileContent = str_replace('%zip_code%', $result->getUser()->getZipCode(), $fileContent);
            $fileContent = str_replace('%address%', $result->getUser()->getAddress(), $fileContent);
            $fileContent = str_replace('%city%', $result->getUser()->getCity(), $fileContent);
            $fileContent = str_replace('%country%', $result->getUser()->getCountry()->getName(), $fileContent);
            $fileContent = str_replace('%stripe_reference%', $result->getStripeReference(), $fileContent);
            $fileContent = str_replace('%vat%', $this->container->getParameter('publipr.settings.default_vat'), $fileContent);
            $fileContent = str_replace('%price_vat%', $price_vat, $fileContent);
            $fileContent = str_replace('%logo%', $this->container->get('request_stack')->getCurrentRequest()->getUriForPath('/app/images/logo-dark.png'), $fileContent);
            return $fileContent;
        }
        catch(\Exception $e)
        {
            return $e;
        }
    }

    /**
     * @Get("/getInvoice/{paymentId}/{isNormal}")
     * @param $paymentId
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function invoiceInfosAction($paymentId, $isNormal)
    {
        try {

            if($isNormal == 1)
            {
                return $this->invoiceFromProduct($paymentId);
            }
            else
            {
                return $this->invoiceFromRecurrent($paymentId);
            }
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function invoiceFromProduct($paymentId)
    {
        $default_vat = $this->container->getParameter('publipr.settings.default_vat');
        $data = array(
            'invoice' => array(),
            'total' => '',
            'vat' => $default_vat,
            'price_vat' => ''
        );

        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->from('PubliPrBundle:Payment', 'p_');
        $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\User', 'creatorUser', \Doctrine\ORM\Query\Expr\Join::WITH, 'p_.creatorUser = creatorUser.id');
        $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\Country', 'Country', \Doctrine\ORM\Query\Expr\Join::WITH, 'creatorUser.country = Country.id');
        $qb->where('p_.id = :id')->setParameter('id', $paymentId);
        $qb->select('p_');
        $result = $qb->getQuery()->getSingleResult();

        if ($result) {
            $price_vat = ($result->getProduct()->getPrice() * $default_vat) / 100;
            $price = $result->getProduct()->getPrice() - $price_vat;
            $result->setAmount($price);
            $data['country'] = $result->getCreatorUser()->getCountry();
            $data['invoice'] = $result;
            $data['price_vat'] = $price_vat;
            $data['total'] = $price + $price_vat;
            $data['id'] = $result->getId();
        }

        return $data;
    }

    private function invoiceFromRecurrent($paymentPlanId)
    {
        $default_vat = $this->container->getParameter('publipr.settings.default_vat');
        $data = array(
            'invoice' => array(),
            'total' => '',
            'vat' => $default_vat,
            'price_vat' => ''
        );

        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->from('PubliPrBundle:UserPaymentPlan', 'p_');
        $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\User', 'user', \Doctrine\ORM\Query\Expr\Join::WITH, 'p_.user = user.id');
        $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\Country', 'Country', \Doctrine\ORM\Query\Expr\Join::WITH, 'user.country = Country.id');
        $qb->where('p_.id = :id')->setParameter('id', $paymentPlanId);
        $qb->select('p_');
        $result = $qb->getQuery()->getSingleResult();

        if ($result) {
            $payment = new Payment();
            $product = new Product();
            $price_vat = ($result->getPaymentPlan()->getAmount() * $default_vat) / 100;
            $price = $result->getPaymentPlan()->getAmount() - $price_vat;
            $payment->setAmount($price);
            $payment->setCreatorUser($result->getUser());
            $payment->setInvoiceNumber($result->getId().'/'.$payment->getCreatorUser()->getId());
            $product->setDescription($result->getPaymentPlan()->getName());
            $product->setName($result->getPaymentPlan()->getName());
            $payment->setProduct($product);
            $data['country'] = $result->getUser()->getCountry();
            $data['invoice'] = $payment;
            $data['price_vat'] = $price_vat;
            $data['total'] = $price + $price_vat;
            $data['id'] = $result->getId();
        }

        return $data;
    }

}
?>
