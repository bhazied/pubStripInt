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
 * Push Device Entity
 * 
 * Storing PushDevices data to the database using Doctrine
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
 * @see        PushDevice
 * @since      Class available since Release 1.0
 * @access     public
 * 
 * @ORM\Table(name="`push_device`", indexes={@ORM\Index(name="creator_user_id", columns={"creator_user_id"}), @ORM\Index(name="modifier_user_id", columns={"modifier_user_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class PushDevice 
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
     * @ORM\Column(name="app_name", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $appName;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="app_version", type="string", length=10, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $appVersion;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="device_uid", type="string", length=40, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $deviceUid;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="device_reg", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $deviceReg;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="device_token", type="string", length=64, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $deviceToken;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="device_name", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $deviceName;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="device_email", type="string", length=400, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $deviceEmail;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="device_model", type="string", length=100, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $deviceModel;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="device_version", type="string", length=50, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $deviceVersion;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="is_enabled_badge", type="boolean", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $isEnabledBadge;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="is_enabled_alert", type="boolean", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $isEnabledAlert;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="is_enabled_sound", type="boolean", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $isEnabledSound;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="development", type="string", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $development;

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
     * @var string
     * @access private
     *
     * @ORM\Column(name="ip", type="string", length=15, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $ip;

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
     * Set appName
     *
     * @access public
     * @param string $appName
     * @return PushDevice
     */
    public function setAppName($appName = null)
    {
        $this->appName = $appName;
        return $this;
    }

    /**
     * Get appName
     *
     * @access public
     * @return string 
     */
    public function getAppName()
    {
        return $this->appName;
    }

    /**
     * Set appVersion
     *
     * @access public
     * @param string $appVersion
     * @return PushDevice
     */
    public function setAppVersion($appVersion = null)
    {
        $this->appVersion = $appVersion;
        return $this;
    }

    /**
     * Get appVersion
     *
     * @access public
     * @return string 
     */
    public function getAppVersion()
    {
        return $this->appVersion;
    }

    /**
     * Set deviceUid
     *
     * @access public
     * @param string $deviceUid
     * @return PushDevice
     */
    public function setDeviceUid($deviceUid = null)
    {
        $this->deviceUid = $deviceUid;
        return $this;
    }

    /**
     * Get deviceUid
     *
     * @access public
     * @return string 
     */
    public function getDeviceUid()
    {
        return $this->deviceUid;
    }

    /**
     * Set deviceReg
     *
     * @access public
     * @param string $deviceReg
     * @return PushDevice
     */
    public function setDeviceReg($deviceReg = null)
    {
        $this->deviceReg = $deviceReg;
        return $this;
    }

    /**
     * Get deviceReg
     *
     * @access public
     * @return string 
     */
    public function getDeviceReg()
    {
        return $this->deviceReg;
    }

    /**
     * Set deviceToken
     *
     * @access public
     * @param string $deviceToken
     * @return PushDevice
     */
    public function setDeviceToken($deviceToken = null)
    {
        $this->deviceToken = $deviceToken;
        return $this;
    }

    /**
     * Get deviceToken
     *
     * @access public
     * @return string 
     */
    public function getDeviceToken()
    {
        return $this->deviceToken;
    }

    /**
     * Set deviceName
     *
     * @access public
     * @param string $deviceName
     * @return PushDevice
     */
    public function setDeviceName($deviceName = null)
    {
        $this->deviceName = $deviceName;
        return $this;
    }

    /**
     * Get deviceName
     *
     * @access public
     * @return string 
     */
    public function getDeviceName()
    {
        return $this->deviceName;
    }

    /**
     * Set deviceEmail
     *
     * @access public
     * @param string $deviceEmail
     * @return PushDevice
     */
    public function setDeviceEmail($deviceEmail = null)
    {
        $this->deviceEmail = $deviceEmail;
        return $this;
    }

    /**
     * Get deviceEmail
     *
     * @access public
     * @return string 
     */
    public function getDeviceEmail()
    {
        return $this->deviceEmail;
    }

    /**
     * Set deviceModel
     *
     * @access public
     * @param string $deviceModel
     * @return PushDevice
     */
    public function setDeviceModel($deviceModel = null)
    {
        $this->deviceModel = $deviceModel;
        return $this;
    }

    /**
     * Get deviceModel
     *
     * @access public
     * @return string 
     */
    public function getDeviceModel()
    {
        return $this->deviceModel;
    }

    /**
     * Set deviceVersion
     *
     * @access public
     * @param string $deviceVersion
     * @return PushDevice
     */
    public function setDeviceVersion($deviceVersion = null)
    {
        $this->deviceVersion = $deviceVersion;
        return $this;
    }

    /**
     * Get deviceVersion
     *
     * @access public
     * @return string 
     */
    public function getDeviceVersion()
    {
        return $this->deviceVersion;
    }

    /**
     * Set isEnabledBadge
     *
     * @access public
     * @param boolean $isEnabledBadge
     * @return PushDevice
     */
    public function setIsEnabledBadge($isEnabledBadge = null)
    {
        $this->isEnabledBadge = $isEnabledBadge;
        return $this;
    }

    /**
     * Get isEnabledBadge
     *
     * @access public
     * @return boolean 
     */
    public function getIsEnabledBadge()
    {
        return $this->isEnabledBadge;
    }

    /**
     * Set isEnabledAlert
     *
     * @access public
     * @param boolean $isEnabledAlert
     * @return PushDevice
     */
    public function setIsEnabledAlert($isEnabledAlert = null)
    {
        $this->isEnabledAlert = $isEnabledAlert;
        return $this;
    }

    /**
     * Get isEnabledAlert
     *
     * @access public
     * @return boolean 
     */
    public function getIsEnabledAlert()
    {
        return $this->isEnabledAlert;
    }

    /**
     * Set isEnabledSound
     *
     * @access public
     * @param boolean $isEnabledSound
     * @return PushDevice
     */
    public function setIsEnabledSound($isEnabledSound = null)
    {
        $this->isEnabledSound = $isEnabledSound;
        return $this;
    }

    /**
     * Get isEnabledSound
     *
     * @access public
     * @return boolean 
     */
    public function getIsEnabledSound()
    {
        return $this->isEnabledSound;
    }

    /**
     * Set development
     *
     * @access public
     * @param string $development
     * @return PushDevice
     */
    public function setDevelopment($development)
    {
        $this->development = $development;
        return $this;
    }

    /**
     * Get development
     *
     * @access public
     * @return string 
     */
    public function getDevelopment()
    {
        return $this->development;
    }

    /**
     * Set status
     *
     * @access public
     * @param string $status
     * @return PushDevice
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
     * Set ip
     *
     * @access public
     * @param string $ip
     * @return PushDevice
     */
    public function setIp($ip = null)
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     * Get ip
     *
     * @access public
     * @return string 
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set createdAt
     *
     * @access public
     * @param \DateTime $createdAt
     * @return PushDevice
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
     * @return PushDevice
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
     * Set creatorUser
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\User $creatorUser
     * @return PushDevice
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
     * @return PushDevice
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
