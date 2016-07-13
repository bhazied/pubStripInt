<?php

namespace ContinuousNet\PubliPrBundle\Controller;

use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\View\View AS FOSView;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use ContinuousNet\PubliPrBundle\Entity\PushDevice;
use ContinuousNet\PubliPrBundle\Entity\Company;

/**
 * Public Api V1 REST Controller
 * 
 * Manage Api V1 
 * 
 * PHP version 5.4.4
 * 
 * @category   Symfony 2 REST Controller
 * @package  ContinuousNet\PubliPrBundle\Controller
 * @author    Sahbi KHALFALLAH <sahbi.khalfallah@continuousnet.com>
 * @copyright  2016 CONTINUOUS NET
 * @license  CONTINUOUS NET REGULAR LICENSE
 * @version  Release: 1.0
 * @link    http://publipr.continuousnet.com/ContinuousNet/PubliPrBundle/Controller
 * @see      ApiV1RESTController
 * @since      Class available since Release 1.0
 * @deprecated Nothing
 * @access    public
 */
class ApiV1RESTController extends FOSRestController
{

    const SESSION_EMAIL = 'fos_user_send_resetting_email/email';

    private $locales = array(
        'en' => 'en_US',
        'fr' => 'fr_FR'
    );

    private function getConfig($path) {
        $config = $this->container->getParameter('publi_pr');
        $paths = explode('.', $path);
        foreach ($paths as $index) {
            $config = $config[$index];
        }
        return $config;
    }

    private function getLanguageByCode($code) {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->from('PubliPrBundle:Language', 'l_');
        $qb->select('l_');
        $qb->andWhere('l_.code = :code')->setParameter('code', $code);
        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @Post("/checkEmail")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function checkEmailAction(Request $request)
    {
        try {
            $email = $request->request->get('email');
            if (!is_null($email) && !empty($email)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $data = array('status' => false, 'message' => null);
                    $em = $this->getDoctrine()->getManager();
                    $qb = $em->createQueryBuilder();
                    $qb->from('PubliPrBundle:User', 'u_');
                    $qb->andWhere('u_.email = :email')->setParameter('email', $email);
                    if (!is_null($this->getUser())) {
                        $qb->andWhere('u_.id != :id')->setParameter('id', $this->getUser()->getId());
                    }
                    $qb->select('count(u_.id)');
                    $count = $qb->getQuery()->getSingleScalarResult();
                    if ($count == 0) {
                        $data['status'] = true;
                        $data['message'] = $this->get('translator')->trans('register.available_email_address');
                    } else {
                        $data['status'] = false;
                        $data['message'] = $this->get('translator')->trans('register.email_already_used');
                    }
                } else {
                    $data['status'] = false;
                    $data['message'] = $this->get('translator')->trans('register.invalid_email');
                }
            } else {
                $data['status'] = false;
                $data['message'] = $this->get('translator')->trans('register.empty_email');
            }
            return $data;
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Post("/checkPhone")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function checkPhoneAction(Request $request)
    {
        try {
            $phone = $request->request->get('phone');
            if (!is_null($phone) && !empty($phone)) {
                if (is_numeric($phone)) {
                    $data = array('status' => false, 'message' => null);
                    $em = $this->getDoctrine()->getManager();
                    $qb = $em->createQueryBuilder();
                    $qb->from('PubliPrBundle:User', 'u_');
                    $qb->andWhere('u_.phone = :phone')->setParameter('phone', $phone);
                    if (!is_null($this->getUser())) {
                        $qb->andWhere('u_.id != :id')->setParameter('id', $this->getUser()->getId());
                    }
                    $qb->select('count(u_.id)');
                    $count = $qb->getQuery()->getSingleScalarResult();
                    if ($count == 0) {
                        $data['status'] = true;
                        $data['message'] = $this->get('translator')->trans('register.available_phone_number');
                    } else {
                        $data['status'] = false;
                        $data['message'] = $this->get('translator')->trans('register.phone_already_used');
                    }
                } else {
                    $data['status'] = false;
                    $data['message'] = $this->get('translator')->trans('register.invalid_phone');
                }
            } else {
                $data['status'] = false;
                $data['message'] = $this->get('translator')->trans('register.empty_phone');
            }
            return $data;
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Get("/countries")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function countriesAction(Request $request)
    {
        try {
            $select = array('c_.id', 'c_.name', 'c_.picture');
            $em = $this->getDoctrine()->getManager();
            $qb = $em->createQueryBuilder();
            $qb->from('PubliPrBundle:Country', 'c_');
            $qb->select($select);
            $qb->addOrderBy('c_.name', 'ASC');
            $countries = $qb->getQuery()->getResult();
            foreach ($countries as $i => $country) {
                $countries[$i]['picture'] = $request->getUriForPath($countries[$i]['picture']);
            }
            return $countries;
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Get("/levels")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function levelsAction(Request $request)
    {
        try {
            return $this->levels;
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Post("/register")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function registerAction(Request $request)
    {
        try {

            $data = array('status' => false, 'message' => null);

            $em = $this->getDoctrine()->getManager();

            $email = $request->request->get('email');
            if (is_null($email) || empty($email)) {
                $data['status'] = false;
                $data['message'] = 'Missing email parameter';
                return $data;
            }

            $emailCheck = $this->checkEmailAction($request);
            if (!$emailCheck['status']) {
                return $emailCheck;
            }
            $postData['email'] = $postData['username'] = $email;

            $name = $request->request->get('name');
            if (is_null($name) || empty($name)) {
                $data['status'] = false;
                $data['message'] = 'Missing name parameter';
                return $data;
            }

            $postData['name'] = $name;

            $recaptchaResponse = $request->request->get('g-recaptcha-response');
            if (is_null($recaptchaResponse) || empty($recaptchaResponse)) {
                $data['status'] = false;
                $data['message'] = 'Missing g-recaptcha-response parameter';
                return $data;
            }

            $postData['recaptchaResponse'] = $recaptchaResponse;

            $password = $request->request->get('password');
            if (is_null($password) || empty($password)) {
                $data['status'] = false;
                $data['message'] = 'Missing password parameter';
                return $data;
            }

            if (strlen($password) < 6) {
                $data['status'] = false;
                $data['message'] = 'Password too short (min 6 characters)';
                return $data;
            }

            if (strlen($password) > 20) {
                $data['status'] = false;
                $data['message'] = 'Password too long (max 20 characters)';
                return $data;
            }
            $postData['plainPassword'] = array('first' => $password, 'second' => $password);

            $postData['type'] = 'Manager';

            $postData['roles'] = array('ROLE_API', 'ROLE_ACCOUNT_MANAGER');

            $request->request->set('app_user_registration', $postData);

            $form = $this->container->get('fos_user.registration.form');
            $formHandler = $this->container->get('fos_user.registration.form.handler');
            $confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');

            try {
                $process = $formHandler->process($confirmationEnabled);
            } catch (\Exception $e) {
                if (json_decode($e->getMessage())) {
                    return json_decode($e->getMessage());
                } else {
                    return $e->getMessage();
                }
            }

            if ($process) {

                $user = $form->getData();

                list($username, $domaine) = explode('@', $user->getEmail());
                list($companyName, $extension) = explode('.', $domaine);
                $company = new Company();
                $company->setIsActive(true);
                $company->setName($user->getEmail());
                $company->setCreatorUser($user);
                $em->persist($company);
                $em->flush();

                $user->setCompany($company);
                $em->flush();

                if ($confirmationEnabled) {
                    $this->container->get('session')->set('fos_user_send_confirmation_email/email', $user->getEmail());
                    $data['status'] = true;
                    $data['message'] = $this->get('translator')->trans('register.confirmation_email_sent_check_email');
                } else {
                    $data['status'] = true;
                    $data['message'] = $this->get('translator')->trans('register.registration_completed');
                    $data['token'] = $this->get("lexik_jwt_authentication.jwt_manager")->create($user);
                    $user->setCurrentLevel(1);
                    $user->setCurrentScore(0);
                    $data['user'] = array(
                        'email' => $user->getEmail(),
                        'gender' => $user->getGender(),
                        'name' => $user->getName(),
                        'address' => $user->getAddress(),
                        'city' => $user->getCity(),
                        'phone' => $user->getPhone(),
                        'country' => $user->getCountry()->getId(),
                        'picture' => $request->getUriForPath($user->getPicture()),
                        'roles' => $user->getRoles()
                    );

                    $em = $this->getDoctrine()->getManager();

                    $em->flush();
                }
            }
            return $data;

        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * @Post("/emailConfirm")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function emailConfirmAction(Request $request) {

        $data = array('status' => false, 'message' => null);

        try {

            $token = $request->request->get('token');

            if (!is_null($token) && !empty($token)) {

                $user = $this->container->get('fos_user.user_manager')->findUserByConfirmationToken($token);

                if (null === $user) {

                    $data['status'] = false;
                    $data['message'] = sprintf($this->get('translator')->trans('register.user_with_confirmation_token_does_not_exist'), $token);

                } else {

                    $user->setConfirmationToken(null);
                    $user->setEnabled(true);
                    $user->setLastLogin(new \DateTime());

                    $this->container->get('fos_user.user_manager')->updateUser($user);

                    $data['status'] = true;
                    $data['message'] = $this->get('translator')->trans('register.email_confirmed');

                    $data = array_merge($data, $this->get('sport_club.event.user_session_data')->sessionData($user));
                }
            } else {
                $data['status'] = false;
                $data['message'] = $this->get('translator')->trans('register.empty_token');
            }
            return $data;

        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get the truncated email displayed when requesting the resetting.
     *
     * The default implementation only keeps the part following @ in the address.
     *
     * @param \FOS\UserBundle\Model\UserInterface $user
     *
     * @return string
     */
    protected function getObfuscatedEmail($user)
    {
        $email = $user->getEmail();
        if (false !== $pos = strpos($email, '@')) {
            $email = '...' . substr($email, $pos);
        }

        return $email;
    }

    /**
     * @Post("/requestResetPassword")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function requestResetPasswordAction(Request $request) {

        $data = array('status' => false, 'message' => null);

        try {

            $email = $request->request->get('email');
            if (!is_null($email) && !empty($email)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $data = array('status' => false, 'message' => null);
                    /** @var $user UserInterface */
                    $user = $this->container->get('fos_user.user_manager')->findUserByUsernameOrEmail($email);
                    if (!is_null($user)) {

                        if (!$user->isPasswordRequestNonExpired($this->container->getParameter('fos_user.resetting.token_ttl'))) {

                            if (null === $user->getConfirmationToken()) {
                                /** @var $tokenGenerator \FOS\UserBundle\Util\TokenGeneratorInterface */
                                $tokenGenerator = $this->container->get('fos_user.util.token_generator');
                                $user->setConfirmationToken($tokenGenerator->generateToken());
                            }

                            $this->container->get('session')->set(static::SESSION_EMAIL, $this->getObfuscatedEmail($user));
                            $this->container->get('fos_user.mailer')->sendResettingEmailMessage($user);
                            $user->setPasswordRequestedAt(new \DateTime());
                            $this->container->get('fos_user.user_manager')->updateUser($user);

                            $data['status'] = true;
                            $data['message'] = $this->get('translator')->trans('reset.reset_password_requested');

                        } else {
                            $data['status'] = false;
                            $data['message'] = $this->get('translator')->trans('reset.password_already_requested');
                        }
                    } else {
                        $data['status'] = false;
                        $data['message'] = $this->get('translator')->trans('reset.no_user_with_this_email');
                    }
                } else {
                    $data['status'] = false;
                    $data['message'] = $this->get('translator')->trans('reset.invalid_email');
                }
            } else {
                $data['status'] = false;
                $data['message'] = $this->get('translator')->trans('reset.empty_email');
            }
            return $data;

        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Post("/reset")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function resetAction(Request $request) {

        $data = array('status' => false, 'message' => null);

        try {

            $token = $request->request->get('token');

            if (!is_null($token) && !empty($token)) {

                $user = $this->container->get('fos_user.user_manager')->findUserByConfirmationToken($token);

                if (null === $user) {

                    $data['status'] = false;
                    $data['message'] = sprintf($this->get('translator')->trans('reset.user_with_confirmation_token_does_not_exist'), $token);

                } else if (!$user->isPasswordRequestNonExpired($this->container->getParameter('fos_user.resetting.token_ttl'))) {

                    $data['status'] = false;
                    $data['message'] = sprintf($this->get('translator')->trans('reset.confirmation_token_is_expired'), $token);

                } else {

                    $jsonData = json_decode($request->getContent(), true);
                    unset($jsonData['locale']);
                    unset($jsonData['token']);

                    $request->request->set('fos_user_resetting_form', $jsonData);

                    $form = $this->container->get('fos_user.resetting.form');
                    $formHandler = $this->container->get('fos_user.resetting.form.handler');
                    $process = $formHandler->process($user);

                    if ($process) {

                        $data['token'] = $this->get("lexik_jwt_authentication.jwt_manager")->create($user);
                        $data['user'] = array(
                            'email' => $user->getEmail(),
                            'username' => $user->getUsername(),
                            'name' => $user->getFirstName() . ' ' . $user->getLastName(),
                            'firstName' => $user->getFirstName(),
                            'lastName' => $user->getLastName(),
                            'job' => $user->getJob(),
                            'picture' => $request->getUriForPath($user->getPicture()),
                            'roles' => $user->getRoles()
                        );
                        $data['status'] = true;
                        $data['message'] = $this->get('translator')->trans('reset.password_changed');

                    } else {
                        $data['status'] = false;
                        $data['message'] = $this->get('translator')->trans('reset.password_not_changed');
                    }

                }

            } else {
                $data['status'] = false;
                $data['message'] = $this->get('translator')->trans('Empty token.');
            }
            return $data;
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Post("/checkConfirmationToken")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function checkConfirmationTokenAction(Request $request) {

        $data = array('status' => false, 'message' => null);

        try {

            $token = $request->request->get('token');

            if (!is_null($token) && !empty($token)) {

                $user = $this->container->get('fos_user.user_manager')->findUserByConfirmationToken($token);

                if (null === $user) {

                    $data['status'] = false;
                    $data['message'] = sprintf($this->get('translator')->trans('register.user_with_confirmation_token_does_not_exist'), $token);

                } else if (!$user->isPasswordRequestNonExpired($this->container->getParameter('fos_user.resetting.token_ttl'))) {

                    $data['status'] = false;
                    $data['message'] = sprintf($this->get('translator')->trans('register.confirmation_token_is_expired'), $token);

                } else {

                    $data['status'] = true;
                    $data['message'] = $this->get('translator')->trans('register.correct_token');

                }
            } else {
                $data['status'] = false;
                $data['message'] = $this->get('translator')->trans('register.empty_token');
            }
            return $data;

        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Post("/registerPush")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function registerPushAction(Request $request)
    {
        try {

            $em = $this->getDoctrine()->getManager();

            $reg = $request->request->get('reg');
            $token = $request->request->get('token');

            if ((is_null($reg) || empty($reg)) && (empty($token) || empty($token))) {
                $data['status'] = false;
                $data['message'] = 'Missing reg and token parameter (reg for android - toke of iOS)';
                return $data;
            }

            $pushDevice = null;
            if (!is_null($reg)) {
                $pushDevice = $em->getRepository('PubliPrBundle:PushDevice')->findOneByDeviceReg($reg);
            } else if (!is_null($token)) {
                $pushDevice = $em->getRepository('PubliPrBundle:PushDevice')->findOneByDeviceToken($token);
            }

            if (!is_null($pushDevice)) {

                try {

                    $pushDevice->setAppName($request->request->get('appName'));
                    $pushDevice->setAppVersion($request->request->get('appVersion'));
                    $pushDevice->setIp($request->getClientIp());

                    $pushDevice->setDeviceUid($request->request->get('deviceUuid'));
                    $pushDevice->setDeviceName($request->request->get('deviceName'));
                    $pushDevice->setDeviceModel($request->request->get('deviceModel'));
                    $pushDevice->setDeviceVersion($request->request->get('deviceVersion'));
                    $pushDevice->setDeviceEmail(null);

                    $pushDevice->setIsEnabledBadge(true);
                    $pushDevice->setIsEnabledAlert(true);
                    $pushDevice->setIsEnabledSound(true);

                    $pushDevice->setDevelopment('Production');
                    $pushDevice->setStatus('Active');
                    $pushDevice->setCreatorUser($this->getUser());
                    $pushDevice->setModifierUser($this->getUser());

                    $em->flush();
                    $data['status'] = true;
                    $data['message'] = 'Push notification updated';
                } catch (\Exception $e) {
                    $data['status'] = false;
                    $data['message'] = 'Push notification no updated '.$e->getMessage();
                }

            } else {

                $pushDevice = new PushDevice();
                $pushDevice->setDeviceReg($reg);
                $pushDevice->setDeviceToken($token);

                $pushDevice->setAppName($request->request->get('appName'));
                $pushDevice->setAppVersion($request->request->get('appVersion'));
                $pushDevice->setIp($request->getClientIp());

                $pushDevice->setDeviceUid($request->request->get('deviceUuid'));
                $pushDevice->setDeviceName($request->request->get('deviceName'));
                $pushDevice->setDeviceModel($request->request->get('deviceModel'));
                $pushDevice->setDeviceVersion($request->request->get('deviceVersion'));
                $pushDevice->setDeviceEmail(null);

                $pushDevice->setIsEnabledBadge(true);
                $pushDevice->setIsEnabledAlert(true);
                $pushDevice->setIsEnabledSound(true);

                $pushDevice->setDevelopment('Production');
                $pushDevice->setStatus('Active');
                $pushDevice->setCreatorUser($this->getUser());

                $data = array();

                try {
                    $em->persist($pushDevice);
                    $em->flush();
                    $data['status'] = true;
                    $data['message'] = 'Push notification registred';
                } catch (\Exception $e) {
                    $data['status'] = false;
                    $data['message'] = 'Push notification not registred '.$e->getMessage();
                }
            }
            return $data;
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Post("/updatePicture")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function updatePictureAction(Request $request)
    {
        try {
            $data = array();
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('PubliPrBundle:User')->find($this->getUser()->getId());

            $picture = $request->request->get('picture');
            if (is_null($picture) || empty($picture)) {
                $data['status'] = false;
                $data['message'] = 'Missing picture parameter';
                return $data;
            }
            $pictureType = $request->request->get('pictureType');
            if (is_null($pictureType) || empty($pictureType)) {
                $data['status'] = false;
                $data['message'] = 'Missing pictureType parameter';
                return $data;
            }
            if ($pictureType != 'jpeg' && $pictureType != 'png' && $pictureType != 'gif') {
                $data['status'] = false;
                $data['message'] = 'incorrect pictureType parameter (jpeg, png, gif)';
                return $data;
            }
            $path = '/uploads/users/'.sprintf('%05d', $this->getUser()->getId()).'_'.date('YmdHis').'.'.$pictureType;
            file_put_contents(self::getWebDir() . $path, base64_decode($picture));
            $value = $path;
            $user->setPicture($value);
            try {
                $em->flush();
                $data['status'] = true;
                $data['message'] = 'Pictrue updated';
            } catch (\Exception $e) {
                $data['status'] = false;
                $data['message'] = 'Pictrue not updated';
            }
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Put("/updateProfile")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function updateProfileAction(Request $request)
    {
        try {
            $data = array();
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('PubliPrBundle:User')->find($this->getUser()->getId());

            $fields = array(
                'name', 'firstName', 'lastName', 'gender', 'country', 'city', 'phone', 'address', 'zipCode'
            );

            $email = $request->request->get('email');
            if (is_null($email) || empty($email)) {
                $data['status'] = false;
                $data['message'] = 'Missing email parameter';
                return $data;
            }

            $name = $request->request->get('name');
            if (is_null($email) || empty($email)) {
                $data['status'] = false;
                $data['message'] = 'Missing name parameter';
                return $data;
            }

            $emailCheck = $this->checkEmailAction($request);
            if (!$emailCheck['status']) {
                return $emailCheck;
            }

            $gender = $request->request->get('gender');
            if (!is_null($gender)) {
                if ($gender != 'Male' && $gender != 'Female') {
                    $data['status'] = false;
                    $data['message'] = 'incorrect gender parameter (Male/Female)';
                    return $data;
                }
            }

            $address = $request->request->get('address');
            if (is_null($address)) {
                $data['status'] = false;
                $data['message'] = 'Missing address parameter';
                return $data;
            }

            $zipCode = $request->request->get('zipCode');
            if (is_null($zipCode)) {
                $data['status'] = false;
                $data['message'] = 'Missing zip code parameter';
                return $data;
            }

            $city = $request->request->get('city');
            if (is_null($city) || empty($city)) {
                $data['status'] = false;
                $data['message'] = 'Missing city parameter';
                return $data;
            }

            $city = $request->request->get('city');
            if (is_null($city) || empty($city)) {
                $data['status'] = false;
                $data['message'] = 'Missing city parameter';
                return $data;
            }

            $country = $request->request->get('country');
            if (is_null($country) || empty($country)) {
                $data['status'] = false;
                $data['message'] = 'Missing country parameter';
                return $data;
            }
            if (!is_numeric($country)) {
                $data['status'] = false;
                $data['message'] = 'Country must be numeric';
                return $data;
            }

            $address = $request->request->get('address');
            if (is_null($address) || empty($address)) {
                $data['status'] = false;
                $data['message'] = 'Missing address parameter';
                return $data;
            }

            $phone = $request->request->get('phone');
            if (!is_null($phone)) {
                $phoneCheck = $this->checkPhoneAction($request);
                if (!$phoneCheck['status']) {
                    return $phoneCheck;
                }
            }

            foreach ($fields as $field) {
                $value = $request->request->get($field);
                if (!is_null($value)) {
                    $method = 'set'.ucfirst($field);
                    if ($field == 'country') {
                        $value = $em->getRepository('PubliPrBundle:Country')->findOneById($value);
                    } else if ($field == 'language') {
                        $value = $em->getRepository('PubliPrBundle:Language')->findOneByCode($value);
                    } else if ($field == 'birthDate') {
                        $value = new \DateTime($value);
                    }
                    $user->$method($value);
                }
            }
            try {
                $em->flush();
                $data['status'] = true;
                $data['message'] = 'Profile updated';
            } catch (\Exception $e) {
                $data['status'] = false;
                $data['message'] = 'Profile not updated';
            }
            return $data;
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public static function getWebDir() {
        return __DIR__ . DIRECTORY_SEPARATOR. '..' . DIRECTORY_SEPARATOR. '..' . DIRECTORY_SEPARATOR. '..' . DIRECTORY_SEPARATOR. '..' . DIRECTORY_SEPARATOR . 'web';
    }


    /**
     * @Get("/getProfile")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function getProfileAction() {
        try {
            $user = $this->getUser();

            $data = array(
                'id' => $user->getId(),
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'username' => $user->getUsername(),
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
                'phone' => $user->getPhone(),
                'job' => $user->getJob(),
                'zipCode' => $user->getZipCode(),
                'city' => $user->getCity(),
                'type' => $user->getType(),
                'gender' => $user->getGender(),
                'address' => $user->getAddress(),
                'country' => $user->getCountry(),
                'picture' => $user->getPicture(),
                'lastLogin' => $user->getLastLogin(),
                'inscriptionDate' => $user->getCreatedAt()
            );

            return $data;
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Post("/changePassword")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function changePasswordAction(Request $request) {

        $data = array('status' => false, 'message' => null);
        try {
            $user = $this->getUser();
            $jsonData = json_decode($request->getContent(), true);

            unset($jsonData['locale']);
            $request->request->set('fos_user_change_password_form', $jsonData);

            $form = $this->container->get('fos_user.change_password.form');
            $formHandler = $this->container->get('fos_user.change_password.form.handler');
            $process = $formHandler->process($user);

            if ($process) {
                $data['status'] = true;
                $data['message'] = $this->get('translator')->trans('Password changed');
            } else {
                $data['status'] = false;
                $data['message'] = $this->get('translator')->trans('Password not changed.');
            }


            return $data;
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


}
