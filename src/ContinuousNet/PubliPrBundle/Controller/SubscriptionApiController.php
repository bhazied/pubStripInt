<?php

namespace ContinuousNet\PubliPrBundle\Controller;
use ContinuousNet\PubliPrBundle\Entity\Contact;
use ContinuousNet\PubliPrBundle\Entity\Email;
use ContinuousNet\PubliPrBundle\Entity\EmailCampaign;
use ContinuousNet\PubliPrBundle\Entity\Newsroom;
use ContinuousNet\PubliPrBundle\Entity\PressRelease;

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
                'validityPeriode' => '',
                'validate' => false,
                'stripToken' => ''            );
            $currentDate = new \DateTime('now');
            $currentDate = $currentDate->format('Y-m-d H:m:s');
            $em = $this->getDoctrine()->getManager();
            $qb = $em->createQueryBuilder();
            $qb->from("PubliPrBundle:Subscription", "sub_");
            $qb->leftJoin("\ContinuousNet\PubliPrBundle\Entity\User", "user", \Doctrine\ORM\Query\Expr\Join::WITH, "sub_.user=user.id");
            $qb->andWhere("sub_.user=:user")->setParameter('user', $this->getUser()->getId());
            $qb->andwhere(":currentDate BETWEEN sub_.startDate AND sub_.endDate")->setParameter('currentDate', $currentDate);
            $qb->select('sub_');
            $result = $qb->getQuery()->getresult();
            if($result){
                $end = new \DateTime($result->getEndDate());
                $diff = $end->diff($currentDate)->days;
                $data['validity_periode'] = $diff;
                $data['validate'] = true;
            }
            return $data;
        }catch (\Exception $e) {
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
                'inlineCount' => ''
            );
            Stripe\Stripe::setApiKey($this->getStripApiKey());
            $products = Stripe\Product::all(array('active' => true));
            if($products){
                foreach ($products['data'] as $product){
                    $data['results'][] = array(
                        'name' => $product->name,
                        'id' => $product->id,
                        'description' => $product->description,
                        'sku' => $product->skus['data']
                    );
                }
            }
            $data['inlineCount'] = count($products['data']);
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
            Stripe\Stripe::setApiKey($this->getStripApiKey());
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
                'error' => '',
                'message' => '',
                'token' => ''
            );
            $cardToken = $this->getCardToken(
                $request->request->get('cardNumber'),
                $request->request->get('cardMonthExpr'),
                $request->request->get('cardYearExpr'),
                $request->request->get('cardCcv')
            );
            if($cardToken){
                $data['error'] = false;
                $data['message'] = $cardToken;
            }
            else
            {
                $data['error'] = false;
            }
            return $request->request->all();
        }catch(\Exception $e){
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
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

            Stripe\Stripe::setApiKey($this->getStripApiKey());
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

    private function getStripApiKey()
    {
        return $this->getParameter('payment.strip.apiKey');
    }
}