<?php

namespace ContinuousNet\PubliPrBundle\Controller;
use ContinuousNet\PubliPrBundle\Entity\Contact;
use ContinuousNet\PubliPrBundle\Entity\Email;
use ContinuousNet\PubliPrBundle\Entity\EmailCampaign;
use ContinuousNet\PubliPrBundle\Entity\Newsroom;
use ContinuousNet\PubliPrBundle\Entity\Payment;
use ContinuousNet\PubliPrBundle\Entity\PaymentPlan;
use ContinuousNet\PubliPrBundle\Entity\PressRelease;

use ContinuousNet\PubliPrBundle\Entity\Product;
use ContinuousNet\PubliPrBundle\Entity\UserPaymentPlan;
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
use Stripe;

class SubscriptionApiController extends FOSRestController
{
    /**
     * @GET("/CheckSubscription")
     * @param $request
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function checkAction(Request $request)
    {
        try {
            $data = array(
                'productName' => '',
                'startDate' => '',
                'endDate' => '',
                'normal_payment' => false,
                'recurrent_payment' => false
            );
            $payment = $this->getPayment();
            if (!is_null($payment)) {
                $data['normal_payment'] = true;
                $data['endDate'] = $payment->getEndDate();
                $data['startDate'] = $payment->getStartDate();
                $data['productName'] = $payment->getProduct()->getName();
            }
            $recurrent = $this->getRecurrent();
            $now = new \DateTime('now');
            if(!is_null($recurrent))
            {
                if($recurrent->getStatus() == 'Disabled' && ($recurrent->getCloseDate() < $now))
                {
                    $data['recurrent_payment'] = false;
                }
                else {
                    $data['recurrent_payment'] = true;
                    if ($recurrent->getPaymentPlan()->getInterval() == 'year') {
                        $data['start_date'] = $recurrent->getCreatedAt();
                        $subscribeDay = $recurrent->getCreatedAt()->format('d');
                        $currenMonth = $recurrent->getCreatedAt()->format('m');
                        $currentYear = $now->format('Y');
                        $datereference = new \DateTime($currentYear . '-' . $currenMonth . '-' . $subscribeDay);
                        $data['end_date'] = $datereference->add(new \DateInterval('P' . $recurrent->getPaymentPlan()->getIntervalCount() . ucfirst(substr($recurrent->getPaymentPlan()->getInterval(), 0, 1))));
                    } else {
                        $data['start_date'] = $recurrent->getCreatedAt();
                        $subscribeDay = $recurrent->getCreatedAt()->format('d');
                        $currenMonth = $now->format('m');
                        $currentYear = $now->format('Y');
                        $datereference = new \DateTime($currentYear . '-' . $currenMonth . '-' . $subscribeDay);
                        $data['end_date'] = $datereference->add(new \DateInterval('P' . $recurrent->getPaymentPlan()->getIntervalCount() . ucfirst(substr($recurrent->getPaymentPlan()->getInterval(), 0, 1))));
                    }
                    if ($recurrent->getStatus() == 'Disabled') {
                        $data['end_date'] = $recurrent->getCloseDate();
                    }
                }

            }

            return $data;
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function getPayment()
    {
        $currentDate = new \DateTime('now');
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('p_');
        $qb->from('PubliPrBundle:Payment', 'p_');
        $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\Product', 'product', \Doctrine\ORM\Query\Expr\Join::WITH, 'p_.product = product.id');
        $qb->leftJoin('\ContinuousNet\PubliPrBundle\Entity\User', 'user', \Doctrine\ORM\Query\Expr\Join::WITH, 'p_.creatorUser=user.id');
        $qb->andWhere('p_.creatorUser=:creatorUser')->setParameter('creatorUser', $this->getUser()->getId());
        $qb->andWhere(':currentDate BETWEEN p_.startDate AND p_.endDate')->setParameter('currentDate', $currentDate);
        $qb->andWhere('p_.isValid = :valid')->setParameter('valid', true);
        $payment = $qb->getQuery()->getOneOrNullResult();
        return $payment;
    }

    private function getRecurrent()
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('p_');
        $qb->from('PubliPrBundle:UserPaymentPlan', 'p_');
        $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\PaymentPlan', 'paymentPlan', \Doctrine\ORM\Query\Expr\Join::WITH, 'p_.paymentPlan = paymentPlan.id');
        $qb->leftJoin('\ContinuousNet\PubliPrBundle\Entity\User', 'user', \Doctrine\ORM\Query\Expr\Join::WITH, 'p_.user=user.id');
        $qb->andWhere('p_.user=:user')->setParameter('user', $this->getUser()->getId());
        $qb->andWhere('paymentPlan.status = :status')->setParameter('status', 'Active');
        $paymentPlan = $qb->getQuery()->getOneOrNullResult();
        return $paymentPlan;
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
            //$data['defaultCurrency'] = $settings->getSetting('DEFAULT_CURRENCY')->getValue();
            $data['defaultCurrency'] = $this->container->getParameter('publipr.settings.default_currency');
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
     * @POST("/SendRecurrent")
     * @param $request
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function sendRecurrentAction(Request $request){
        try{
            $response = array(
                'hasError' => false,
                'message' => ''
            );
            $em = $this->getDoctrine()->getManager();
            $paymentPlan = $em->getRepository('PubliPrBundle:PaymentPlan')->find($request->request->get('interval'));
            Stripe\Stripe::setApiKey($this->getStripeApiKey());
            if( is_null($this->getUser()->getStripeReference()))
            {
                //createCustomer througth stripe
                $customerStripe =Stripe\Customer::create(array(
                    'description' => 'customer for '.$this->getUser()->getEmail(),
                    'email' => $this->getUser()->getEmail(),
                    'plan' => $paymentPlan->getStripeReference(),
                    'source' => array(
                        'object' => 'card',
                        'exp_month' => $request->request->get('cardMonthExpr'),
                        'exp_year' => $request->request->get('cardYearExpr'),
                        'number' => $request->request->get('cardNumber'),
                        'cvc' => $request->request->get('cvc'),
                        'name' => 'Card for User '. $this->getUser()->getName()
                    )
                ));
                if(!is_string($customerStripe)){
                    $this->getUser()->setStripereference($customerStripe->id);
                    $em->persist($this->getUser());
                    $userPaymentPlan = $this->addUserPaymentPlan($paymentPlan, $customerStripe->subscriptions->data[0]->id, $em);
                    $em->persist($userPaymentPlan);
                    $em->flush();
                    //$response['message'] = $this->get('translator')->trans('recurrent.payment.success');
                    $response['message'] = "Recurrent payment success";
                    $this->sendConfirmationRecurrent($userPaymentPlan);
                }
                else
                {
                    $response['message'] = $customerStripe;
                    $response['hasError'] = true;
                }
            }
            else
            {
                //user created in stripe test
                //check stripe subscription
                $subscription = $this->checkCustomerSubStripe($this->getUser()->getStripereference());
                if($subscription->subscriptions->total_count == 0)
                {
                    $subscription = Stripe\Subscription::create(array(
                        'customer' => $this->getUser()->getStripereference(),
                        'plan' => $paymentPlan->getStripeReference(),
                        'source' => array(
                            'object' => 'card',
                            'exp_month' => $request->request->get('cardMonthExpr'),
                            'exp_year' => $request->request->get('cardYearExpr'),
                            'number' => $request->request->get('cardNumber'),
                            'cvc' => $request->request->get('cvc'),
                            'name' => 'Card for '. $this->getUser()->getName()
                        )
                    ));
                    if(!is_string($subscription))
                    {
                        $userPaymentPlan = $this->addUserPaymentPlan($paymentPlan, $subscription->id, $em);
                        $em->persist($userPaymentPlan);
                        $em->flush();
                        $this->sendConfirmationRecurrent($userPaymentPlan);
                        //$response['message'] = $this->get('translator')->trans('recurrent.payment.success');
                        $response['message'] = "Recurrent payment success";
                    }
                    else
                    {
                        $response['message'] = $subscription;
                        $response['hasError'] = true;
                    }
                }
                else
                {
                    $userPaymentPlan = $this->addUserPaymentPlan($paymentPlan, $subscription->subscriptions->data[0]->id, $em);
                    $em->persist($userPaymentPlan);
                    $em->flush();
                    $this->sendConfirmationRecurrent($userPaymentPlan);
                    //$response['message'] = $this->get('translator')->trans('recurrent.payment.success');
                    $response['message'] = "Recurrent payment success";
                }
            }
            return $response;
        }
        catch (\Exception $e)
        {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



    /**
     * @POST("/Unsubscribe")
     * @param $request
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function unsubscribeAction(Request $request)
    {
        try
        {
            $data= array(
                'hasError' => false,
                'message' => ''
            );
            $em = $this->getDoctrine()->getManager();
            $userPaymentPlan = $em->getRepository('PubliPrBundle:UserPaymentPlan')->find($request->request->get('id'));
            Stripe\Stripe::setApiKey($this->getStripeApiKey());
            $subscribtion = Stripe\Subscription::retrieve($request->request->get('stripeReference'));
            $result = $subscribtion->cancel();
            $em = $this->getDoctrine()->getManager();
            $userPaymentPlan = $em->getRepository('PubliPrBundle:UserPaymentPlan')->find($request->request->get('id'));
            $userPaymentPlan->setCloseDate(new \DateTime('now'));
            $userPaymentPlan->getUser()->setStripeReference(null);
            $userPaymentPlan->setStatus("Disabled");
            $em->flush();

        }
        catch (\Exception $e)
        {
            return $data['message'] = $e->getMessage();
        }
    }


    private function addUserPaymentPlan(PaymentPlan $paymentPlan, $subId, EntityManager $em)
    {
        $userPaymentPlan = new UserPaymentPlan();
        $userPaymentPlan->setUser($this->getUser());
        $userPaymentPlan->setPaymentPlan($paymentPlan);
        $userPaymentPlan->setStatus("Active");
        $userPaymentPlan->setStripereference($subId);
        return $userPaymentPlan;
    }

    private function checkCustomerSubStripe($cusStripeReference)
    {

        Stripe\Stripe::setApiKey($this->getStripeApiKey());
        $customer = Stripe\Customer::retrieve($cusStripeReference);
        return $customer;
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
        $baseUrl = $this->container->get('request_stack')->getCurrentRequest()->getScheme().'://'.$this->container->get('request_stack')->getCurrentRequest()->getHttpHost().'/';
        try
        {
            //$id = !is_null($payment->getToken())  ? $payment->getToken() : $payment->getStripeReference();
            $id = $payment->getToken();
            $message = \Swift_Message::newInstance()
                ->setSubject('PubliPr Payment')
                ->setFrom($this->container->getParameter('publipr.contact.email'))
                ->setFrom("contact@continuousnet.com")
                ->setTo($payment->getCreatorUser()->getEmail())
                ->setContentType('text/html')
                ->setBody(
                    $this->renderView(
                        'PubliPrBundle:Emails:invoice.html.twig',
                         array(
                            'user_name' => $payment->getCreatorUser()->getFirstName() . ' ' . $payment->getCreatorUser()->getLastName(),
                            'created_at' => $payment->getCreatedAt()->format('F j, Y'),
                             'order_id' => $id,
                             'link' => $baseUrl.'#/app/billing/invoice/'.$payment->getId(),
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

    private function  sendConfirmationRecurrent($paymentPlan)
    {
        $baseUrl = $this->container->get('request_stack')->getCurrentRequest()->getScheme().'://'.$this->container->get('request_stack')->getCurrentRequest()->getHttpHost().'/';
        try
        {
            //$id = !is_null($payment->getToken())  ? $payment->getToken() : $payment->getStripeReference();
            $id = $paymentPlan->getStripereference();
            $message = \Swift_Message::newInstance()
                ->setSubject('PubliPr Payment')
                ->setFrom($this->container->getParameter('publipr.contact.email'))
                ->setFrom("contact@continuousnet.com")
                ->setTo($paymentPlan->getUser()->getEmail())
                ->setContentType('text/html')
                ->setBody(
                    $this->renderView(
                        'PubliPrBundle:Emails:invoice.html.twig',
                        array(
                            'user_name' => $paymentPlan->getUser()->getFirstName() . ' ' . $paymentPlan->getUser()->getLastName(),
                            'created_at' => $paymentPlan->getCreatedAt()->format('F j, Y'),
                            'order_id' => $id,
                            'link' => $baseUrl.'#/app/billing/invoice/'.$paymentPlan->getId(),
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