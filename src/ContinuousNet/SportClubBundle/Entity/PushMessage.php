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
 * Push Message Entity
 * 
 * Storing PushMessages data to the database using Doctrine
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
 * @see        PushMessage
 * @since      Class available since Release 1.0
 * @access     public
 * 
 * @ORM\Table(name="`push_message`", indexes={@ORM\Index(name="push_device_id", columns={"push_device_id"}), @ORM\Index(name="push_notification_id", columns={"push_notification_id"}), @ORM\Index(name="creator_user_id", columns={"creator_user_id"}), @ORM\Index(name="modifier_user_id", columns={"modifier_user_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class PushMessage 
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
     * @var \DateTime
     * @access private
     *
     * @ORM\Column(name="delivery", type="datetime", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $delivery;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="sending_status", type="string", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $sendingStatus;

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
     * @var \ContinuousNet\SportClubBundle\Entity\PushDevice
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="PushDevice")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="push_device_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $pushDevice;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\PushNotification
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="PushNotification")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="push_notification_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $pushNotification;

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
     * Set delivery
     *
     * @access public
     * @param \DateTime $delivery
     * @return PushMessage
     */
    public function setDelivery(\DateTime $delivery = null)
    {
        $this->delivery = $delivery;
        return $this;
    }

    /**
     * Get delivery
     *
     * @access public
     * @return \DateTime 
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * Set sendingStatus
     *
     * @access public
     * @param string $sendingStatus
     * @return PushMessage
     */
    public function setSendingStatus($sendingStatus)
    {
        $this->sendingStatus = $sendingStatus;
        return $this;
    }

    /**
     * Get sendingStatus
     *
     * @access public
     * @return string 
     */
    public function getSendingStatus()
    {
        return $this->sendingStatus;
    }

    /**
     * Set createdAt
     *
     * @access public
     * @param \DateTime $createdAt
     * @return PushMessage
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
     * @return PushMessage
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
     * Set pushDevice
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\PushDevice $pushDevice
     * @return PushMessage
     */
    public function setPushDevice(PushDevice $pushDevice = null)
    {
        $this->pushDevice = $pushDevice;
        return $this;
    }

    /**
     * Get pushDevice
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\PushDevice 
     */
    public function getPushDevice()
    {
        return $this->pushDevice;
    }

    /**
     * Set pushNotification
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\PushNotification $pushNotification
     * @return PushMessage
     */
    public function setPushNotification(PushNotification $pushNotification = null)
    {
        $this->pushNotification = $pushNotification;
        return $this;
    }

    /**
     * Get pushNotification
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\PushNotification 
     */
    public function getPushNotification()
    {
        return $this->pushNotification;
    }

    /**
     * Set creatorUser
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\User $creatorUser
     * @return PushMessage
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
     * @return PushMessage
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
