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
use ContinuousNet\PubliPrBundle\Entity\Game;
use ContinuousNet\PubliPrBundle\Entity\Score;

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
 * @link    http://buckshunter.continuousnet.com/ContinuousNet/PubliPrBundle/Controller
 * @see      ApiV1RESTController
 * @since      Class available since Release 1.0
 * @deprecated Nothing
 * @access    public
 */
class ApiV1RESTController extends FOSRestController
{

    const SESSION_EMAIL = 'fos_user_send_resetting_email/email';

    private $locales = array(
        'en' => 'en_US'
    );

    private $scoreTypes = array(
        'GameWon' => 0,
        'Register' => 5,
        'Facebook' => 10,
        'Twitter' => 10,
        'Istagram' => 10,
        'AppRating' => 10,
        'Invitation' => 20,
        'VideoAd' => 5
    );

    private $levels = array(
        array('id' => 1, 'cols' => 3, 'rows' => 4, 'minBucks' => 0, 'maxTime' => 120, 'scoreBucks' => 5),
        array('id' => 2, 'cols' => 4, 'rows' => 5, 'minBucks' => 500, 'maxTime' => 180, 'scoreBucks' => 10),
        array('id' => 3, 'cols' => 5, 'rows' => 6, 'minBucks' => 1000, 'maxTime' => 300, 'scoreBucks' => 20),
        array('id' => 4, 'cols' => 6, 'rows' => 7, 'minBucks' => 2000, 'maxTime' => 600, 'scoreBucks' => 40)
    );

    private function getConfig($path) {
        $config = $this->container->getParameter('bucks_hunter');
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

            $gender = $request->request->get('gender');
            if (is_null($gender) || empty($gender)) {
                $data['status'] = false;
                $data['message'] = 'Missing gender parameter';
                return $data;
            }

            if ($gender != 'Male' && $gender != 'Female') {
                $data['status'] = false;
                $data['message'] = 'incorrect gender parameter (Male/Female)';
                return $data;
            }
            $postData['gender'] = $gender;

            $nickname = $request->request->get('nickname');
            if (is_null($nickname) || empty($nickname)) {
                $data['status'] = false;
                $data['message'] = 'Missing nickname parameter';
                return $data;
            }
            $postData['nickname'] = $nickname;

            $name = $request->request->get('name');
            if (is_null($name) || empty($name)) {
                $data['status'] = false;
                $data['message'] = 'Missing name parameter';
                return $data;
            }
            $postData['name'] = $name;

            $country = $request->request->get('country');
            if (is_null($country) || empty($country)) {
                $data['status'] = false;
                $data['message'] = 'Missing country parameter';
                return $data;
            }
            if (!is_numeric($country)) {
                $data['status'] = false;
                $data['message'] = 'country must be numeric';
                return $data;
            }
            $_country = $em->getRepository('PubliPrBundle:Country')->findOneById($country);
            $postData['country'] = $country;

            $city = $request->request->get('city');
            if (is_null($city) || empty($city)) {
                $data['status'] = false;
                $data['message'] = 'Missing city parameter';
                return $data;
            }
            $postData['city'] = $city;

            $address = $request->request->get('address');
            if (is_null($address) || empty($address)) {
                $data['status'] = false;
                $data['message'] = 'Missing address parameter';
                return $data;
            }
            $postData['address'] = $address;

            $phone = $request->request->get('phone');
            if (is_null($phone) || empty($phone)) {
                $data['status'] = false;
                $data['message'] = 'Missing phone parameter';
                return $data;
            }

            $phoneCheck = $this->checkPhoneAction($request);
            if (!$phoneCheck['status']) {
                return $phoneCheck;
            }
            $postData['phone'] = $phone;

            $password = $request->request->get('password');
            if (is_null($password) || empty($password)) {
                $data['status'] = false;
                $data['message'] = 'Missing password parameter';
                return $data;
            }

            if (strlen($password) < 6) {
                $data['status'] = false;
                $data['message'] = 'password too short (min 6 characters)';
                return $data;
            }

            if (strlen($password) > 20) {
                $data['status'] = false;
                $data['message'] = 'password too long (max 20 characters)';
                return $data;
            }
            $postData['plainPassword'] = array('first' => $password, 'second' => $password);
            //$postData['password'] = $password;

            $postData['type'] = 'Gamer';

            $postData['roles'] = array('ROLE_API', 'ROLE_GAMER');

            $postData['picture'] = '/assets/images/'.strtolower($postData['gender']).'.png';

            $request->request->set('app_user_registration', $postData);

            $form = $this->container->get('fos_user.registration.form');
            $formHandler = $this->container->get('fos_user.registration.form.handler');
            $confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');

            $process = $formHandler->process($confirmationEnabled);

            if ($process) {

                $user = $form->getData();

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
                        'nickname' => $user->getNickname(),
                        'name' => $user->getName(),
                        'address' => $user->getAddress(),
                        'city' => $user->getCity(),
                        'phone' => $user->getPhone(),
                        'country' => $user->getCountry()->getId(),
                        'picture' => $request->getUriForPath($user->getPicture()),
                        'roles' => $user->getRoles(),
                        'currentLevel' => $user->getCurrentLevel(),
                        'currentScore' => $user->getCurrentScore()
                    );

                    $em = $this->getDoctrine()->getManager();

                    $em->flush();
                }
                return $data;
            }

        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * @Post("/updateScore")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function updateScoreAction(Request $request) {

        $data = array('status' => false, 'message' => null);

        $type = $request->request->get('type');
        if (is_null($type) || empty($type)) {
            $data['status'] = false;
            $data['message'] = 'Missing type parameter';
            return $data;
        }

        if (!in_array($type, array_keys($this->scoreTypes))) {
            $data['status'] = false;
            $data['message'] = 'incorrect type parameter ('.implode(',', array_keys($this->scoreTypes)).')';
            return $data;
        }

        $em = $this->getDoctrine()->getManager();

        $gameId = null;
        $game_time = null;
        $value = $this->scoreTypes[$type];

        if ($type == 'GameWon') {

            $gameId = $request->request->get('gameId');

            if (is_null($gameId) || empty($gameId)) {

                $data['status'] = false;
                $data['message'] = 'Missing gameId parameter';

                return $data;

            } else {

                $game = $this->getGame($request, $gameId);

                if (is_null($game)) {
                    $data['status'] = false;
                    $data['message'] = 'incorrect gameId parameter';
                    return $data;

                }

            }

            if ($game['gameStatus'] == 'Ended' || $game['gameStatus'] == 'Scored') {
                if ($game['meAppTime'] > $game['partnerAppTime']) {
                    $game_time = $game['meAppTime'];
                    foreach ($this->levels as $i => $level) {
                        if ($game['level'] == $level['id']) {
                            if ($game['meAppTime'] <= $level['maxTime']) {
                                $value = $level['scoreBucks'];
                            }
                        }
                    }
                }
            }

        }

        try {

            $newScore = $this->getUser()->getCurrentScore() + $value;
            $this->addScore($type, $value, $gameId, $game_time);

            $this->getUser()->setCurrentScore($newScore);
            $newLevel = $this->getUser()->getCurrentLevel();
            foreach ($this->levels as $i => $level) {
                if ($newScore >= $level['minBucks']) {
                    $newLevel = $level['id'];
                }
            }
            $this->getUser()->setCurrentLevel($newLevel);
            $em->flush();

            $data['status'] = false;
            $data['message'] = 'score updated with '.$value.' bucks';

            return $data;

        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function addScore($type, $value, $gameId = null, $game_time = null) {
        $em = $this->getDoctrine()->getManager();
        $score = new Score();
        $score->setType($type);
        $score->setValue($value);
        $score->setCreatorUser($this->getUser());
        $score->setGame($em->getRepository('PubliPrBundle:Game')->find($gameId));
        $score->setGameTime($game_time);
        $em = $this->getDoctrine()->getManager();
        $em->persist($score);
        $em->flush();
    }

    /**
     * @Post("/searchPlayer")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function searchPlayerAction(Request $request) {

        $data = array('status' => false, 'message' => null);

        try {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $gameId = $request->request->get('gameId');

            $select = array('g_.id');
            $qb = $em->createQueryBuilder();
            $qb->select($select);
            $qb->from('PubliPrBundle:Game', 'g_');
            $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\Puzzle', 'puzzle', \Doctrine\ORM\Query\Expr\Join::WITH, 'g_.puzzle = puzzle.id');
            $qb->andWhere('g_.status IN (:statuses)')->setParameter('statuses', array('Searching', 'Matching'));
            $qb->andWhere('g_.player1User = :user')->setParameter('user', $user->getId());
            $qb->groupBy('g_.id');
            $qb->setMaxResults(1);
            $qb->addOrderBy('g_.createdAt', 'DESC');
            $game = $qb->getQuery()->getOneOrNullResult();
            if (!is_null($game)) {
                $gameId = $game['id'];
            }
            if (is_null($gameId)) {

                $select = array('g_.id');
                $qb = $em->createQueryBuilder();
                $qb->select($select);
                $qb->from('PubliPrBundle:Game', 'g_');
                $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\Puzzle', 'puzzle', \Doctrine\ORM\Query\Expr\Join::WITH, 'g_.puzzle = puzzle.id');
                $qb->andWhere('g_.status = :status')->setParameter('status', 'Searching');
                $qb->andWhere('g_.level = :level')->setParameter('level', $user->getCurrentLevel());
                $qb->andWhere('g_.player1User != :user')->setParameter('user', $user->getId());
                $qb->andWhere('g_.player2User IS NULL');
                $qb->groupBy('g_.id');
                $qb->setMaxResults(1);
                $qb->addOrderBy('g_.createdAt', 'ASC');
                $game = $qb->getQuery()->getOneOrNullResult();

                if (is_null($game)) {

                    $select = array('p_.id');
                    $qb = $em->createQueryBuilder();
                    $qb->select($select);
                    $qb->from('PubliPrBundle:Puzzle', 'p_');
                    $qb->andWhere('p_.status = :status')->setParameter('status', 'Online');
                    $qb->groupBy('p_.id');
                    $puzzles = $qb->getQuery()->getResult();
                    shuffle($puzzles);

                    $game = new Game();
                    $game->setPlayer1User($user);
                    $game->setPreferred(false);
                    $game->setStatus('Searching');
                    $game->setLevel($user->getCurrentLevel());
                    $game->setPuzzle($em->getRepository('PubliPrBundle:Puzzle')->find($puzzles[0]['id']));
                    $game->setCreatorUser($user);
                    $em->persist($game);
                    $em->flush();

                    $data['status'] = true;
                    $data['message'] = 'Searching';
                    $data['gameId'] = $game->getId();

                    return $data;

                } else {

                    $game = $em->getRepository('PubliPrBundle:Game')->find($game['id']);
                    $game->setPlayer2User($user);
                    $game->setStatus('Matching');
                    $em->flush();

                    $data['status'] = true;
                    $data['message'] = $game->getStatus();
                    $data['gameId'] = $game->getId();

                    $data = array_merge($data, $this->getGame($request, $game->getId()));

                    return $data;

                }

            } else {

                $select = array('g_.id', 'g_.status');
                $qb = $em->createQueryBuilder();
                $qb->select($select);
                $qb->from('PubliPrBundle:Game', 'g_');
                $qb->andWhere('g_.id = :id')->setParameter('id', $gameId);
                $qb->groupBy('g_.id');
                $qb->setMaxResults(1);
                $qb->addOrderBy('g_.createdAt', 'ASC');
                $game = $qb->getQuery()->getOneOrNullResult();

                $data['status'] = true;
                $data['message'] = $game['status'];
                $data['gameId'] = $gameId;

                if ($game['status'] != 'Searching') {

                    $game = $em->getRepository('PubliPrBundle:Game')->find($game['id']);
                    $game->setStatus('Matched');
                    $em->flush();

                    $data = array_merge($data, $this->getGame($request, $game->getId()));
                }

                return $data;

            }

        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * @Post("/startGame")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function startGameAction(Request $request) {


        $data = array('status' => false, 'message' => null);

        try {
            $gameId = $request->request->get('gameId');
            if (is_null($gameId) || empty($gameId)) {
                $data['status'] = false;
                $data['message'] = 'Missing gameId parameter';
                return $data;
            }
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $game = $em->getRepository('PubliPrBundle:Game')->find($gameId);
            if ($game->setPlayer1User()->getId() == $user->getId()) {
                $game->setPlayer1StartTime(new \DateTime('now'));
            } else if ($game->setPlayer2User()->getId() == $user->getId()) {
                $game->setPlayer2StartTime(new \DateTime('now'));
            }
            if ($game->getStatus() == 'Matching') {
                $game->setStatus('Strated');
            } else if ($game->getStatus() == 'Strated') {
                $game->setStatus('Playing');
            }
            $em->flush();
            $data['status'] = true;
            $data['message'] = 'StratGameStatusChanged';
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * @Post("/ranking")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function rankingAction(Request $request) {

        $data = array('status' => false, 'message' => null);

        try {
            $limit = 10;
            $type = $request->request->get('type');
            if (is_null($type) || empty($type)) {
                $data['status'] = false;
                $data['message'] = 'Missing type parameter';
                return $data;
            }
            if ($type != 'Global' && $type != 'Friends' && $type != 'Winners') {
                $data['status'] = false;
                $data['message'] = 'incorrect type parameter (Global, Friends, Winners)';
                return $data;
            }

            $select = array(
                'u_.id as playerId', 'u_.currentLevel as playerCurrentLevel', 'u_.picture as playerPicture',
                'u_.nickname as playerNickname', 'u_.currentScore as playerCurrentScore',
            );
            $em = $this->getDoctrine()->getManager();
            $qb = $em->createQueryBuilder();
            $qb->select($select);
            $qb->from('PubliPrBundle:User', 'u_');
            $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\Country', 'country', \Doctrine\ORM\Query\Expr\Join::WITH, 'u_.country = country.id');
            $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\Language', 'language', \Doctrine\ORM\Query\Expr\Join::WITH, 'u_.language = language.id');
            $qb->andWhere('u_.type = :type')->setParameter('type', 'Gamer');
            if ($type != 'Global') {
                $qb->andWhere('u_.id != :id')->setParameter('id', $this->getId());
                if ($type == 'Friends') {

                }
                if ($type == 'Winners') {

                }
            }
            $qb->addOrderBy('u_.currentScore', 'DESC');
            $qb->setMaxResults($limit);
            $users = $qb->getQuery()->getResult();
            foreach ($users as $i => $user) {
                $users[$i]['playerPicture'] = $request->getUriForPath($users[$i]['playerPicture']);
            }
            return $users;

        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    /**
     * @Post("/endGame")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function endGameAction(Request $request) {


        $data = array('status' => false, 'message' => null);

        try {
            $gameId = $request->request->get('gameId');
            if (is_null($gameId) || empty($gameId)) {
                $data['status'] = false;
                $data['message'] = 'Missing gameId parameter';
                return $data;
            }
            $time = $request->request->get('time');
            if (is_null($time) || empty($time)) {
                $data['status'] = false;
                $data['message'] = 'Missing time parameter';
                return $data;
            }
            if (!is_numeric($time)) {
                $data['status'] = false;
                $data['message'] = 'time must be numeric';
                return $data;
            }
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $game = $em->getRepository('PubliPrBundle:Game')->find($gameId);
            if ($game->setPlayer1User()->getId() == $user->getId()) {
                $game->setPlayer1EndTime(new \DateTime('now'));
                $game->setPlayer1AppTime($time);
            } else if ($game->setPlayer2User()->getId() == $user->getId()) {
                $game->setPlayer2EndTime(new \DateTime('now'));
                $game->setPlayer2AppTime($time);
            }
            if ($game->getStatus() == 'Playing') {
                $game->setStatus('Ended');
            } else if ($game->getStatus() == 'Ended') {
                $game->setStatus('Scored');
            }
            $em->flush();
            $data['status'] = true;
            $data['message'] = 'EndGameStatusChanged';
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    private function getGame($request, $gameId) {

        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $select = array(
            'puzzle.picture as puzzlePicture', 'puzzle.name as puzzleName', 'g_.level', 'g_.status as gameStatus',
            'g_.player1AppTime', 'g_.player2AppTime',
            'g_.player1StartTime', 'g_.player2StartTime', 'g_.player1EndTime', 'g_.player2EndTime',
            'player1_user.id as player1Id', 'player1_user.picture as player1Picture',
            'player1_user.nickname as player1Nickname', 'player1_user.currentScore as player1CurrentScore',
            'country1.id as player1CountryId', 'country1.name as player1CountryName', 'country1.picture as player1CountryPicture',
            'player2_user.id as player2Id', 'player2_user.picture as player2Picture',
            'player2_user.nickname as player2Nickname', 'player2_user.currentScore as player2CurrentScore',
            'country2.id as player2CountryId', 'country2.name as player2CountryName', 'country2.picture as player2CountryPicture',
        );
        $qb->from('PubliPrBundle:Game', 'g_');
        $qb->select($select);
        $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\User', 'player1_user', \Doctrine\ORM\Query\Expr\Join::WITH, 'g_.player1User = player1_user.id');
        $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\Country', 'country1', \Doctrine\ORM\Query\Expr\Join::WITH, 'player1_user.country = country1.id');
        $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\User', 'player2_user', \Doctrine\ORM\Query\Expr\Join::WITH, 'g_.player2User = player2_user.id');
        $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\Country', 'country2', \Doctrine\ORM\Query\Expr\Join::WITH, 'player2_user.country = country2.id');
        $qb->leftJoin('ContinuousNet\PubliPrBundle\Entity\Puzzle', 'puzzle', \Doctrine\ORM\Query\Expr\Join::WITH, 'g_.puzzle = puzzle.id');
        $qb->andWhere('g_.id = :id')->setParameter('id', $gameId);
        $game = $qb->getQuery()->getOneOrNullResult();

        if (!is_null($game)) {

            $game['player1ServerTime'] = 0;
            if (!is_null($game['player1StartTime'])) {
                if (!is_null($game['player1EndTime'])) {
                    $game['player1ServerTime'] = strtotime($game['player1EndTime']) - strtotime($game['player1StartTime']);
                } else {
                    $game['player1ServerTime'] = time() - strtotime($game['player1StartTime']);
                }
            }

            $game['player2ServerTime'] = 0;
            if (!is_null($game['player2StartTime'])) {
                if (!is_null($game['player2EndTime'])) {
                    $game['player2ServerTime'] = strtotime($game['player2EndTime']) - strtotime($game['player2StartTime']);
                } else {
                    $game['player2ServerTime'] = time() - strtotime($game['player2StartTime']);
                }
            }

            $game['player1CountryPicture'] = $request->getUriForPath($game['player1CountryPicture']);
            $game['player2CountryPicture'] = $request->getUriForPath($game['player2CountryPicture']);
            $game['player1Picture'] = $request->getUriForPath($game['player1Picture']);
            $game['player2Picture'] = $request->getUriForPath($game['player2Picture']);
            $game['puzzlePicture'] = $request->getUriForPath($game['puzzlePicture']);

            $from = array('player1', 'player2');

            if ($this->getUser()->getId() == $game['player1Id']) {
                $to = array('me', 'partner');
            } else if ($this->getUser()->getId() == $game['player2Id']) {
                $to = array('partner', 'me');
            }

            foreach ($game as $key => $value) {
                unset($game[$key]);
                $newKey = str_replace($from, $to, $key);
                $game[$newKey] = $value;
            }

        }

        return $game;
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
     * @Post("/updateProfile")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function updateProfileAction(Request $request)
    {
        try {
            $data = array();
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('PubliPrBundle:User')->find($this->getUser()->getId());
            $fields = array(
                'email', 'gender', 'nickname', 'country', 'city', 'phone'
            );
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

            $gender = $request->request->get('gender');
            if (is_null($gender) || empty($gender)) {
                $data['status'] = false;
                $data['message'] = 'Missing gender parameter';
                return $data;
            }

            if ($gender != 'Male' && $gender != 'Female') {
                $data['status'] = false;
                $data['message'] = 'incorrect gender parameter (Male/Female)';
                return $data;
            }

            $nickname = $request->request->get('nickname');
            if (is_null($nickname) || empty($nickname)) {
                $data['status'] = false;
                $data['message'] = 'Missing nickname parameter';
                return $data;
            }

            $name = $request->request->get('name');
            if (is_null($name) || empty($name)) {
                $data['status'] = false;
                $data['message'] = 'Missing name parameter';
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

            $city = $request->request->get('city');
            if (is_null($city) || empty($city)) {
                $data['status'] = false;
                $data['message'] = 'Missing city parameter';
                return $data;
            }

            $address = $request->request->get('address');
            if (is_null($address) || empty($address)) {
                $data['status'] = false;
                $data['message'] = 'Missing address parameter';
                return $data;
            }

            $phone = $request->request->get('phone');
            if (is_null($phone) || empty($phone)) {
                $data['status'] = false;
                $data['message'] = 'Missing phone parameter';
                return $data;
            }

            $phoneCheck = $this->checkPhoneAction($request);
            if (!$phoneCheck['status']) {
                return $phoneCheck;
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
     * @Post("/ad")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function adAction(Request $request) {


        $data = array('status' => false, 'message' => null);

        try {

            $type = $request->request->get('type');
            if (is_null($type) || empty($type)) {
                $data['status'] = false;
                $data['message'] = 'Missing type parameter';
                return $data;
            }
            if ($type != 'Image' && $type != 'Video') {
                $data['status'] = false;
                $data['message'] = 'incorrect type parameter (Image, Video)';
                return $data;
            }

            $em = $this->getDoctrine()->getManager();

            $select = array('b_.id', 'b_.name', 'b_.broughtByText', 'b_.broughtByPicture', 'b_.text', 'b_.picture', 'b_.url');

            $qb = $em->createQueryBuilder();
            $qb->select($select);
            $qb->from('PubliPrBundle:Banner', 'b_');
            $qb->andWhere('b_.status = :status')->setParameter('status', 'Online');
            $qb->andWhere('b_.type = :type')->setParameter('type', $type);
            $qb->groupBy('b_.id');
            $banners= $qb->getQuery()->getResult();
            shuffle($banners);

            if (isset($banners[0])) {

                $data['status'] = true;
                $data['message'] = 'Banner OK';

                $banners[0]['broughtByPicture'] = $request->getUriForPath($banners[0]['broughtByPicture']);
                $banners[0]['picture'] = $request->getUriForPath($banners[0]['picture']);
                $data = array_merge($data, $banners[0]);

            } else {

                $data['status'] = false;
                $data['message'] = 'No banner';

            }

            return $data;

        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


}
