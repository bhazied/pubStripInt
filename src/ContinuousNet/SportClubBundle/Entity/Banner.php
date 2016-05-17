<?php

namespace ContinuousNet\SportClubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Events;
use Doctrine\Common\Collections\ArrayCollection as DoctrineCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Annotation\Groups;

/**
 * Banner Entity
 * 
 * Storing Banners data to the database using Doctrine
 * 
 * PHP version 5.4.4
 * 
 * @category   Doctrine 2 Entity
 * @package    ContinuousNet\SportClubBundle\Entity
 * @author     Sahbi KHALFALLAH <sahbi.khalfallah@continuousnet.com>
 * @copyright  2016 CONTINUOUS NET
 * @license	CONTINUOUS NET REGULAR LICENSE
 * @version    Release: 1.0
 * @link       http://sportclub.continuousnet.com/ContinuousNet/SportClubBundle/Entity
 * @see        Banner
 * @since      Class available since Release 1.0
 * @access     public
 * 
 * @ORM\Table(name="`banner`", indexes={@ORM\Index(name="banner_type_id", columns={"banner_type_id"}), @ORM\Index(name="creator_user_id", columns={"creator_user_id"}), @ORM\Index(name="modifier_user_id", columns={"modifier_user_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class Banner 
{
    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="id", type="integer", nullable=false, unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     * @Expose
     * 
     */
    private $id;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="name", type="string", length=320, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $name;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="picture", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $picture;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="iphone_action", type="string", length=320, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $iphoneAction;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="android_action", type="string", length=320, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $androidAction;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="web_action", type="string", length=320, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $webAction;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="gender", type="string", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $gender;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="min_age", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $minAge;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="max_age", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $maxAge;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="priority", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $priority;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="web_url", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $webUrl;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="phone_number_to_call", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $phoneNumberToCall;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="sms_mobile_number", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $smsMobileNumber;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="sms_body", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $smsBody;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="email_adress", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $emailAdress;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="email_subject", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $emailSubject;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="email_body", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $emailBody;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="android_app_url", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $androidAppUrl;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="iphone_app_url", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $iphoneAppUrl;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="youtube_url", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $youtubeUrl;

    /**
     * @var float
     * @access private
     *
     * @ORM\Column(name="map_latitude", type="float", precision=10, scale=0, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $mapLatitude;

    /**
     * @var float
     * @access private
     *
     * @ORM\Column(name="map_longitude", type="float", precision=10, scale=0, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $mapLongitude;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="screen", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $screen;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="screen_parameters", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $screenParameters;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="total_hits", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $totalHits;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="today_hits", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $todayHits;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="total_clicks", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $totalClicks;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="today_clicks", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $todayClicks;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="template", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $template;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="ad_text", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $adText;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="text_color", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $textColor;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="background_color", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $backgroundColor;

    /**
     * @var \DateTime
     * @access private
     *
     * @ORM\Column(name="start_publishing", type="datetime", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $startPublishing;

    /**
     * @var \DateTime
     * @access private
     *
     * @ORM\Column(name="end_publishing", type="datetime", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $endPublishing;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="start_publishing_time", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $startPublishingTime;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="end_publishing_time", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $endPublishingTime;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="max_clicks_per_day", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $maxClicksPerDay;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="max_total_clicks", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $maxTotalClicks;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="max_hits_per_day", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $maxHitsPerDay;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="max_total_hits", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $maxTotalHits;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="status", type="string", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $status;

    /**
     * @var \DateTime
     * @access private
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @access private
     *
     * @ORM\Column(name="modified_at", type="datetime", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $modifiedAt;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\BannerType
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="BannerType")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="banner_type_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $bannerType;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\User
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="creator_user_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $creatorUser;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\User
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="modifier_user_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $modifierUser;

    /**
     * Constructor
     * 
     * @access public
     */
    public function __construct()
    {
    }

    /**
     * Get id
     *
     * @access public
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @access public
     * @param string $name
     * @return Banner
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @access public
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set picture
     *
     * @access public
     * @param string $picture
     * @return Banner
     */
    public function setPicture($picture = null)
    {
        $this->picture = $picture;
        return $this;
    }

    /**
     * Get picture
     *
     * @access public
     * @return string 
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set iphoneAction
     *
     * @access public
     * @param string $iphoneAction
     * @return Banner
     */
    public function setIphoneAction($iphoneAction)
    {
        $this->iphoneAction = $iphoneAction;
        return $this;
    }

    /**
     * Get iphoneAction
     *
     * @access public
     * @return string 
     */
    public function getIphoneAction()
    {
        return $this->iphoneAction;
    }

    /**
     * Set androidAction
     *
     * @access public
     * @param string $androidAction
     * @return Banner
     */
    public function setAndroidAction($androidAction)
    {
        $this->androidAction = $androidAction;
        return $this;
    }

    /**
     * Get androidAction
     *
     * @access public
     * @return string 
     */
    public function getAndroidAction()
    {
        return $this->androidAction;
    }

    /**
     * Set webAction
     *
     * @access public
     * @param string $webAction
     * @return Banner
     */
    public function setWebAction($webAction)
    {
        $this->webAction = $webAction;
        return $this;
    }

    /**
     * Get webAction
     *
     * @access public
     * @return string 
     */
    public function getWebAction()
    {
        return $this->webAction;
    }

    /**
     * Set gender
     *
     * @access public
     * @param string $gender
     * @return Banner
     */
    public function setGender($gender = null)
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * Get gender
     *
     * @access public
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set minAge
     *
     * @access public
     * @param integer $minAge
     * @return Banner
     */
    public function setMinAge($minAge = null)
    {
        $this->minAge = $minAge;
        return $this;
    }

    /**
     * Get minAge
     *
     * @access public
     * @return integer 
     */
    public function getMinAge()
    {
        return $this->minAge;
    }

    /**
     * Set maxAge
     *
     * @access public
     * @param integer $maxAge
     * @return Banner
     */
    public function setMaxAge($maxAge = null)
    {
        $this->maxAge = $maxAge;
        return $this;
    }

    /**
     * Get maxAge
     *
     * @access public
     * @return integer 
     */
    public function getMaxAge()
    {
        return $this->maxAge;
    }

    /**
     * Set priority
     *
     * @access public
     * @param integer $priority
     * @return Banner
     */
    public function setPriority($priority = null)
    {
        $this->priority = $priority;
        return $this;
    }

    /**
     * Get priority
     *
     * @access public
     * @return integer 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set webUrl
     *
     * @access public
     * @param string $webUrl
     * @return Banner
     */
    public function setWebUrl($webUrl = null)
    {
        $this->webUrl = $webUrl;
        return $this;
    }

    /**
     * Get webUrl
     *
     * @access public
     * @return string 
     */
    public function getWebUrl()
    {
        return $this->webUrl;
    }

    /**
     * Set phoneNumberToCall
     *
     * @access public
     * @param string $phoneNumberToCall
     * @return Banner
     */
    public function setPhoneNumberToCall($phoneNumberToCall = null)
    {
        $this->phoneNumberToCall = $phoneNumberToCall;
        return $this;
    }

    /**
     * Get phoneNumberToCall
     *
     * @access public
     * @return string 
     */
    public function getPhoneNumberToCall()
    {
        return $this->phoneNumberToCall;
    }

    /**
     * Set smsMobileNumber
     *
     * @access public
     * @param string $smsMobileNumber
     * @return Banner
     */
    public function setSmsMobileNumber($smsMobileNumber = null)
    {
        $this->smsMobileNumber = $smsMobileNumber;
        return $this;
    }

    /**
     * Get smsMobileNumber
     *
     * @access public
     * @return string 
     */
    public function getSmsMobileNumber()
    {
        return $this->smsMobileNumber;
    }

    /**
     * Set smsBody
     *
     * @access public
     * @param string $smsBody
     * @return Banner
     */
    public function setSmsBody($smsBody = null)
    {
        $this->smsBody = $smsBody;
        return $this;
    }

    /**
     * Get smsBody
     *
     * @access public
     * @return string 
     */
    public function getSmsBody()
    {
        return $this->smsBody;
    }

    /**
     * Set emailAdress
     *
     * @access public
     * @param string $emailAdress
     * @return Banner
     */
    public function setEmailAdress($emailAdress = null)
    {
        $this->emailAdress = $emailAdress;
        return $this;
    }

    /**
     * Get emailAdress
     *
     * @access public
     * @return string 
     */
    public function getEmailAdress()
    {
        return $this->emailAdress;
    }

    /**
     * Set emailSubject
     *
     * @access public
     * @param string $emailSubject
     * @return Banner
     */
    public function setEmailSubject($emailSubject = null)
    {
        $this->emailSubject = $emailSubject;
        return $this;
    }

    /**
     * Get emailSubject
     *
     * @access public
     * @return string 
     */
    public function getEmailSubject()
    {
        return $this->emailSubject;
    }

    /**
     * Set emailBody
     *
     * @access public
     * @param string $emailBody
     * @return Banner
     */
    public function setEmailBody($emailBody = null)
    {
        $this->emailBody = $emailBody;
        return $this;
    }

    /**
     * Get emailBody
     *
     * @access public
     * @return string 
     */
    public function getEmailBody()
    {
        return $this->emailBody;
    }

    /**
     * Set androidAppUrl
     *
     * @access public
     * @param string $androidAppUrl
     * @return Banner
     */
    public function setAndroidAppUrl($androidAppUrl = null)
    {
        $this->androidAppUrl = $androidAppUrl;
        return $this;
    }

    /**
     * Get androidAppUrl
     *
     * @access public
     * @return string 
     */
    public function getAndroidAppUrl()
    {
        return $this->androidAppUrl;
    }

    /**
     * Set iphoneAppUrl
     *
     * @access public
     * @param string $iphoneAppUrl
     * @return Banner
     */
    public function setIphoneAppUrl($iphoneAppUrl = null)
    {
        $this->iphoneAppUrl = $iphoneAppUrl;
        return $this;
    }

    /**
     * Get iphoneAppUrl
     *
     * @access public
     * @return string 
     */
    public function getIphoneAppUrl()
    {
        return $this->iphoneAppUrl;
    }

    /**
     * Set youtubeUrl
     *
     * @access public
     * @param string $youtubeUrl
     * @return Banner
     */
    public function setYoutubeUrl($youtubeUrl = null)
    {
        $this->youtubeUrl = $youtubeUrl;
        return $this;
    }

    /**
     * Get youtubeUrl
     *
     * @access public
     * @return string 
     */
    public function getYoutubeUrl()
    {
        return $this->youtubeUrl;
    }

    /**
     * Set mapLatitude
     *
     * @access public
     * @param float $mapLatitude
     * @return Banner
     */
    public function setMapLatitude($mapLatitude = null)
    {
        $this->mapLatitude = $mapLatitude;
        return $this;
    }

    /**
     * Get mapLatitude
     *
     * @access public
     * @return float 
     */
    public function getMapLatitude()
    {
        return $this->mapLatitude;
    }

    /**
     * Set mapLongitude
     *
     * @access public
     * @param float $mapLongitude
     * @return Banner
     */
    public function setMapLongitude($mapLongitude = null)
    {
        $this->mapLongitude = $mapLongitude;
        return $this;
    }

    /**
     * Get mapLongitude
     *
     * @access public
     * @return float 
     */
    public function getMapLongitude()
    {
        return $this->mapLongitude;
    }

    /**
     * Set screen
     *
     * @access public
     * @param string $screen
     * @return Banner
     */
    public function setScreen($screen = null)
    {
        $this->screen = $screen;
        return $this;
    }

    /**
     * Get screen
     *
     * @access public
     * @return string 
     */
    public function getScreen()
    {
        return $this->screen;
    }

    /**
     * Set screenParameters
     *
     * @access public
     * @param string $screenParameters
     * @return Banner
     */
    public function setScreenParameters($screenParameters = null)
    {
        $this->screenParameters = $screenParameters;
        return $this;
    }

    /**
     * Get screenParameters
     *
     * @access public
     * @return string 
     */
    public function getScreenParameters()
    {
        return $this->screenParameters;
    }

    /**
     * Set totalHits
     *
     * @access public
     * @param integer $totalHits
     * @return Banner
     */
    public function setTotalHits($totalHits = null)
    {
        $this->totalHits = $totalHits;
        return $this;
    }

    /**
     * Get totalHits
     *
     * @access public
     * @return integer 
     */
    public function getTotalHits()
    {
        return $this->totalHits;
    }

    /**
     * Set todayHits
     *
     * @access public
     * @param integer $todayHits
     * @return Banner
     */
    public function setTodayHits($todayHits = null)
    {
        $this->todayHits = $todayHits;
        return $this;
    }

    /**
     * Get todayHits
     *
     * @access public
     * @return integer 
     */
    public function getTodayHits()
    {
        return $this->todayHits;
    }

    /**
     * Set totalClicks
     *
     * @access public
     * @param integer $totalClicks
     * @return Banner
     */
    public function setTotalClicks($totalClicks = null)
    {
        $this->totalClicks = $totalClicks;
        return $this;
    }

    /**
     * Get totalClicks
     *
     * @access public
     * @return integer 
     */
    public function getTotalClicks()
    {
        return $this->totalClicks;
    }

    /**
     * Set todayClicks
     *
     * @access public
     * @param integer $todayClicks
     * @return Banner
     */
    public function setTodayClicks($todayClicks = null)
    {
        $this->todayClicks = $todayClicks;
        return $this;
    }

    /**
     * Get todayClicks
     *
     * @access public
     * @return integer 
     */
    public function getTodayClicks()
    {
        return $this->todayClicks;
    }

    /**
     * Set template
     *
     * @access public
     * @param string $template
     * @return Banner
     */
    public function setTemplate($template = null)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * Get template
     *
     * @access public
     * @return string 
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Set adText
     *
     * @access public
     * @param string $adText
     * @return Banner
     */
    public function setAdText($adText = null)
    {
        $this->adText = $adText;
        return $this;
    }

    /**
     * Get adText
     *
     * @access public
     * @return string 
     */
    public function getAdText()
    {
        return $this->adText;
    }

    /**
     * Set textColor
     *
     * @access public
     * @param string $textColor
     * @return Banner
     */
    public function setTextColor($textColor = null)
    {
        $this->textColor = $textColor;
        return $this;
    }

    /**
     * Get textColor
     *
     * @access public
     * @return string 
     */
    public function getTextColor()
    {
        return $this->textColor;
    }

    /**
     * Set backgroundColor
     *
     * @access public
     * @param string $backgroundColor
     * @return Banner
     */
    public function setBackgroundColor($backgroundColor = null)
    {
        $this->backgroundColor = $backgroundColor;
        return $this;
    }

    /**
     * Get backgroundColor
     *
     * @access public
     * @return string 
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * Set startPublishing
     *
     * @access public
     * @param \DateTime $startPublishing
     * @return Banner
     */
    public function setStartPublishing(\DateTime $startPublishing = null)
    {
        $this->startPublishing = $startPublishing;
        return $this;
    }

    /**
     * Get startPublishing
     *
     * @access public
     * @return \DateTime 
     */
    public function getStartPublishing()
    {
        return $this->startPublishing;
    }

    /**
     * Set endPublishing
     *
     * @access public
     * @param \DateTime $endPublishing
     * @return Banner
     */
    public function setEndPublishing(\DateTime $endPublishing = null)
    {
        $this->endPublishing = $endPublishing;
        return $this;
    }

    /**
     * Get endPublishing
     *
     * @access public
     * @return \DateTime 
     */
    public function getEndPublishing()
    {
        return $this->endPublishing;
    }

    /**
     * Set startPublishingTime
     *
     * @access public
     * @param integer $startPublishingTime
     * @return Banner
     */
    public function setStartPublishingTime($startPublishingTime = null)
    {
        $this->startPublishingTime = $startPublishingTime;
        return $this;
    }

    /**
     * Get startPublishingTime
     *
     * @access public
     * @return integer 
     */
    public function getStartPublishingTime()
    {
        return $this->startPublishingTime;
    }

    /**
     * Set endPublishingTime
     *
     * @access public
     * @param integer $endPublishingTime
     * @return Banner
     */
    public function setEndPublishingTime($endPublishingTime = null)
    {
        $this->endPublishingTime = $endPublishingTime;
        return $this;
    }

    /**
     * Get endPublishingTime
     *
     * @access public
     * @return integer 
     */
    public function getEndPublishingTime()
    {
        return $this->endPublishingTime;
    }

    /**
     * Set maxClicksPerDay
     *
     * @access public
     * @param integer $maxClicksPerDay
     * @return Banner
     */
    public function setMaxClicksPerDay($maxClicksPerDay = null)
    {
        $this->maxClicksPerDay = $maxClicksPerDay;
        return $this;
    }

    /**
     * Get maxClicksPerDay
     *
     * @access public
     * @return integer 
     */
    public function getMaxClicksPerDay()
    {
        return $this->maxClicksPerDay;
    }

    /**
     * Set maxTotalClicks
     *
     * @access public
     * @param integer $maxTotalClicks
     * @return Banner
     */
    public function setMaxTotalClicks($maxTotalClicks = null)
    {
        $this->maxTotalClicks = $maxTotalClicks;
        return $this;
    }

    /**
     * Get maxTotalClicks
     *
     * @access public
     * @return integer 
     */
    public function getMaxTotalClicks()
    {
        return $this->maxTotalClicks;
    }

    /**
     * Set maxHitsPerDay
     *
     * @access public
     * @param integer $maxHitsPerDay
     * @return Banner
     */
    public function setMaxHitsPerDay($maxHitsPerDay = null)
    {
        $this->maxHitsPerDay = $maxHitsPerDay;
        return $this;
    }

    /**
     * Get maxHitsPerDay
     *
     * @access public
     * @return integer 
     */
    public function getMaxHitsPerDay()
    {
        return $this->maxHitsPerDay;
    }

    /**
     * Set maxTotalHits
     *
     * @access public
     * @param integer $maxTotalHits
     * @return Banner
     */
    public function setMaxTotalHits($maxTotalHits = null)
    {
        $this->maxTotalHits = $maxTotalHits;
        return $this;
    }

    /**
     * Get maxTotalHits
     *
     * @access public
     * @return integer 
     */
    public function getMaxTotalHits()
    {
        return $this->maxTotalHits;
    }

    /**
     * Set status
     *
     * @access public
     * @param string $status
     * @return Banner
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get status
     *
     * @access public
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set createdAt
     *
     * @access public
     * @param \DateTime $createdAt
     * @return Banner
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Get createdAt
     *
     * @access public
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set modifiedAt
     *
     * @access public
     * @param \DateTime $modifiedAt
     * @return Banner
     */
    public function setModifiedAt(\DateTime $modifiedAt = null)
    {
        $this->modifiedAt = $modifiedAt;
        return $this;
    }

    /**
     * Get modifiedAt
     *
     * @access public
     * @return \DateTime 
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }

    /**
     * Set bannerType
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\BannerType $bannerType
     * @return Banner
     */
    public function setBannerType(BannerType $bannerType = null)
    {
        $this->bannerType = $bannerType;
        return $this;
    }

    /**
     * Get bannerType
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\BannerType 
     */
    public function getBannerType()
    {
        return $this->bannerType;
    }

    /**
     * Set creatorUser
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\User $creatorUser
     * @return Banner
     */
    public function setCreatorUser(User $creatorUser = null)
    {
        $this->creatorUser = $creatorUser;
        return $this;
    }

    /**
     * Get creatorUser
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\User 
     */
    public function getCreatorUser()
    {
        return $this->creatorUser;
    }

    /**
     * Set modifierUser
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\User $modifierUser
     * @return Banner
     */
    public function setModifierUser(User $modifierUser = null)
    {
        $this->modifierUser = $modifierUser;
        return $this;
    }

    /**
     * Get modifierUser
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\User 
     */
    public function getModifierUser()
    {
        return $this->modifierUser;
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->setModifiedAt(new \DateTime('now'));
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        if (is_null($this->getCreatedAt()))
        {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }
}
