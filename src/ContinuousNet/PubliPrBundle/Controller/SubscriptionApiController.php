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
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
use ContinuousNet\PubliPrBundle\Services\Settings;
use Stripe;

class SubscriptionApiController extends FOSRestController
{
/**
 * @GET("/CheckSubscription")
 * @param $request
 * @View(serializerEnableMaxDepthChecks=true)
 */
    public function checkAction(Request $request){
        try{
            $data = array(
                'startDate' => '',
                'endDate' => '',
                'validate' => false
                );
            $currentDate = new \DateTime('now');
            //$currentDate = $currentDate->format('Y-m-d H:m:s');
            $em = $this->getDoctrine()->getManager();
            $qb = $em->createQueryBuilder();
            $qb->from("PubliPrBundle:Payment", "pay_");
            $qb->leftJoin("\ContinuousNet\PubliPrBundle\Entity\User", "user", \Doctrine\ORM\Query\Expr\Join::WITH, "pay_.creatorUser=user.id");
            $qb->andWhere("pay_.creatorUser=:creatorUser")->setParameter('creatorUser', $this->getUser()->getId());
            $qb->andWhere(":currentDate BETWEEN pay_.startDate AND pay_.endDate")->setParameter('currentDate', $currentDate);
            $qb->andWhere("pay_.isValid = :valid")->setParameter('valid', true);
            $qb->select('pay_');
            $result = $qb->getQuery()->getresult();
            if($result){
                $end = $result[0]->getEndDate();
                //$diff = $end->diff($currentDate)->days;
                //$data['validityPeriode'] = $diff;
                $data['validate'] = true;
                $data['startDate'] = "";
                $data['startDate'] = "";
            }
            return $data;
        }catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @POST("/CheckUser")
     * @param $request
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function checkUserAction(Request $request)
    {
        try{
            $data = array( 'checked' => ( $this->getUser()->getAddress() &&
                     $this->getUser()->getName()    &&
                     $this->getUser()->getCountry() &&
                     $this->getUser()->getZipCode() &&
                     $this->getUser()->getCity())
            );
            return $data;
        }catch (\Exception $e)
        {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @GET("/Products")
     * @param $request
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function productsAction(Request $request)
    {
        try{
            $data = array(
                'results' => array(),
                'inlineCount' => 0
            );
            $em = $this->getDoctrine()->getManager();
            $products = $em->getRepository('PubliPrBundle:Product')->findByStatus('Online');
            if($products){
                foreach ($products as $product)
                {
                    $data['results'][] = array(
                        'name' => $product->getName(),
                        'id' => $product->getStripeReference(),
                        'description' => $product->getDescription(),
                        'sku' => $product->getPrice(),
                    );
                }
                $data['inlineCount'] = count($products);
            }
            return $data;
        }catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @GET("/Settings/{product}")
     * @param $product
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function settingsAction($product)
    {
        try{
            $data= array(
                'defaultCurrency' => '',
                'sku' => array()
            );
            $settings = $this->get('publi_pr.settings');
            $data['defaultCurrency'] = $settings->getSetting('DEFAULT_CURRENCY')->getValue();
            //get price bt product passed in request
            Stripe\Stripe::setApiKey($this->getStripeApiKey());
            $skus = Stripe\SKU::all(array(
                'active' => true,
                'product' => $product,
                'limit' => 1
            ));
            if($skus['data'])
            {
                foreach ($skus['data'] as $sku)
                {
                    $data['sku'] = array(
                        'id' => $sku->id,
                        'price' => $sku->price,
                        'priceFormatted' => money_format('%(#1n', $sku->price/100),
                        'currency' => $sku->currency,
                    );
                }
            }
            return $data;
        }catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @POST("/SendPurchase")
     * @param Request $request
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function sendPurchaseAction(Request $request)
    {
        try{
            $data = array(
                'hasError' => '',
                'message' => '',
            );
            $cardToken = $this->getCardToken($request->request->get('cardNumber'),$request->request->get('cardMonthExpr'),$request->request->get('cardYearExpr'), $request->request->get('cardCcv'));
            if(!$cardToken){
                $data['hasError'] = true;
                $data['message'] = "No Token taken";
                return $data;
            }
            //create Order througth Stripe Api
            $params = array('skuId' => $request->request->get('skuId'),'currency' => $request->request->get('currency'), $request->request->get('discountCode'));
            $order = $this->createStripeOrder($params);
            if(!$order)
            {
                $data['hasError'] = true;
                $data['message'] = "No Order created";
                return $data;
            }
            //initiate payment in database
            $data = array(
                'amount' => $order->amount,
                'currency' => $order->currency,
                'details' => $request->request->get('details'),
                'discountCode' => $request->request->get('discountCode'),
                'productStripeId' => $request->request->get('productStripeId'),
                'ip' => $request->getClientIp(),
                'status' => $order->status,
                'orderStripeId' => $order->id
            );
            $payment = $this->initiPayment($data);
            //order payment througth Stripe
            $paymentOrder = $this->payOrder($order, $cardToken);
            if($paymentOrder->status == 'paid'){
                $data['hasError'] = false;
                $data['message'] = "payment sucess";
                $data['paymentId'] = $payment->getId();
                $payment->setIsValid(true);
                $this->updatePaymentWithStatus($payment, $paymentOrder);
                //send Email
                $sent = $this->sendConfirmationEmail($payment);
                return $data;
            }
            else
            {
                $data['hasError'] = true;
                $data['message'] = "payment failure";
                $this->updatePaymentWithStatus($payment, $paymentOrder);
                return $data;
            }

        }catch(\Exception $e){
            $data['hasError'] = true;
            $data['message'] = $e->getMessage();
            return $data;
        }
    }


    /**
     * @param $data
     * @return Payment
     */
    private function initiPayment($data)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository("PubliPrBundle:Product")->findOneBy(array('stripeReference' => $data['productStripeId']));
        $payment = new Payment();
        $payment->setAmount($product->getPrice());
        $payment->setCurrency($data['currency']);
        $payment->setDetails(array($data['details']));
        $payment->setStartDate(new \DateTime('now'));
        $payment->setEndDate(new \DateTime('+'.$product->getDuration().' day'));
        $payment->setCreatorUser($this->getUser());
        $payment->setDiscountCode($data['discountCode']);
        $payment->setProduct($product);
        $payment->setCreatedAt(new \DateTime('now'));
        $payment->setIp($data['ip']);
        $payment->setStatus($data['status']);
        $payment->setIsValid(false);
        $payment->setToken($data['orderStripeId']);
        $em->persist($payment);
        $em->flush();
        return $payment;
    }

    private function updatePaymentWithStatus(Payment $payment, $paymentOrder)
    {
        $payment->setStatus($paymentOrder->status);
        $payment->setModifiedAt(new \DateTime('now'));
        $payment->setModifierUser($this->getUser());
        if($paymentOrder->status == 'paid')
        {
            $payment->setInvoiceNumber($payment->getId(). $payment->getCreatorUser()->getId().'/'.$payment->getCreatedAt()->format('Y'));
        }
        $em = $this->getDoctrine()->getManager();
        $em->persist($payment);
        $em->flush();
        return $payment;
    }


    private function payOrder(Stripe\Order $order, $cardToken)
    {
        try{
            Stripe\Stripe::setApiKey($this->getStripeApiKey());
            return $order->pay(array('source' => $cardToken));
        }catch(\Exception $e){
            return false;
        }
    }

    /**
     * @param $card_number
     * @param $card_month_expr
     * @param $card_year_expr
     * @param $card_ccv
     * @return bool|mixed|null
     */

    private function getCardToken($card_number, $card_month_expr,$card_year_expr, $card_ccv)
    {
        try{

            Stripe\Stripe::setApiKey($this->getStripeApiKey());
           $result =  Stripe\Token::create(array(
                "card" => array(
                    "number" => $card_number,
                    "exp_month" => $card_month_expr,
                    "exp_year" => $card_year_expr,
                    "cvc" => $card_ccv
                )
            ));
            $result = json_encode($result);
            if(json_last_error() === JSON_ERROR_NONE){
                $result = json_decode($result);
                return $result->id;
            }
            return false;
        }catch(Exception $ex){
            return false;
        }
    }

    private function createStripeOrder($params)
    {
        try{
            $user = $this->getUser();
            Stripe\Stripe::setApiKey($this->getStripeApiKey());
            $order = Stripe\Order::create(array(
                'items' => array(array(
                    'type' => 'sku',
                    'parent' => $params['skuId']
                )),
                'currency' => $params['currency'],
                //'coupon' => $params['discountCode'],
                'shipping' => array(
                    'name' => $user->getName(),
                    'address' => array(
                        'line1' => $user->getAddress(),
                        'city' => $user->getCity(),
                        'country' => $user->getCountry()->getCode(),
                        'postal_code' => $user->getZipCode()
                    )
                ),
                'email' => $user->getEmail()
            ));
            $orderObject = $order;
            return $orderObject;
            $order = json_encode($order);
            if(json_last_error() === JSON_ERROR_NONE)
            {
                return $orderObject;
            }
            else
            {
                return false;
            }
        }catch (\Exception $ex)
        {
            return false;
        }

    }

    private function sendConfirmationEmail($payment)
    {
        try
        {
            $message = \Swift_Message::newInstance()
                ->setSubject('PubliPr Payment')
                ->setFrom($this->container->getParameter('publipr.contact.email'))
                ->setFrom("contact@continuousnet.com")
                ->setTo($payment->getCreatorUser()->getEmail())
                ->setBody(
                    $this->renderView(
                        'Emails/invoice.html.twig',
                         array(
                            'total' => $payment->getProduct()->getPrice(),
                            'user_name' => $payment->getCreatorUser()->getFirstName() . ' ' . $payment->getCreatorUser()->getLastName(),
                            'invoice_number' => $payment->getInvoiceNumber(),
                            'created_at' => $payment->getCreatedAt()->format('F j, Y'),
                            'product_name' => $payment->getProduct()->getName(),
                            'product_price' => $payment->getProduct()->getPrice(),
                            'url' => 'http://publipr',
                            'publipr_contact' => $this->container->getParameter('publipr.contact.address')
                        )
                    ),
                    'text/html'
                );
           return $this->get('mailer')->send($message);
        }
        catch(\Exception $e)
        {
           return false;
        }
    }

    private function getStripeApiKey()
    {
        return $this->getParameter('payment.strip.apiKey');
    }

}