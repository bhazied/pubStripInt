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
 * Subscription Entity
 * 
 * Storing Subscriptions data to the database using Doctrine
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
 * @see        Subscription
 * @since      Class available since Release 1.0
 * @access     public
 * 
 * @ORM\Table(name="`subscription`", indexes={@ORM\Index(name="visit_id", columns={"visit_id"}), @ORM\Index(name="package_id", columns={"package_id"}), @ORM\Index(name="price_id", columns={"price_id"}), @ORM\Index(name="creator_user_id", columns={"creator_user_id"}), @ORM\Index(name="modifier_user_id", columns={"modifier_user_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class Subscription 
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
     * @ORM\Column(name="reference", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $reference;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="token", type="string", length=15, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $token;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="msisdn", type="string", length=15, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $msisdn;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="voucher", type="string", length=50, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $voucher;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="serial_number", type="string", length=50, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $serialNumber;

    /**
     * @var float
     * @access private
     *
     * @ORM\Column(name="amount", type="float", precision=10, scale=0, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $amount;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="currency", type="string", length=3, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $currency;

    /**
     * @var float
     * @access private
     *
     * @ORM\Column(name="duration", type="float", precision=10, scale=0, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $duration;

    /**
     * @var \DateTime
     * @access private
     *
     * @ORM\Column(name="start_date", type="datetime", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $startDate;

    /**
     * @var \DateTime
     * @access private
     *
     * @ORM\Column(name="end_date", type="datetime", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $endDate;

    /**
     * @var float
     * @access private
     *
     * @ORM\Column(name="price_value", type="float", precision=10, scale=0, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $priceValue;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="user_agent", type="text", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $userAgent;

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
     * @var \ContinuousNet\SportClubBundle\Entity\Visit
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Visit")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="visit_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $visit;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\Package
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Package")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="package_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $package;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\Price
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Price")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="price_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $price;

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
     * Set status
     *
     * @access public
     * @param string $status
     * @return Subscription
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
     * Set reference
     *
     * @access public
     * @param string $reference
     * @return Subscription
     */
    public function setReference($reference = null)
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * Get reference
     *
     * @access public
     * @return string 
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set token
     *
     * @access public
     * @param string $token
     * @return Subscription
     */
    public function setToken($token = null)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * Get token
     *
     * @access public
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set msisdn
     *
     * @access public
     * @param string $msisdn
     * @return Subscription
     */
    public function setMsisdn($msisdn = null)
    {
        $this->msisdn = $msisdn;
        return $this;
    }

    /**
     * Get msisdn
     *
     * @access public
     * @return string 
     */
    public function getMsisdn()
    {
        return $this->msisdn;
    }

    /**
     * Set voucher
     *
     * @access public
     * @param string $voucher
     * @return Subscription
     */
    public function setVoucher($voucher = null)
    {
        $this->voucher = $voucher;
        return $this;
    }

    /**
     * Get voucher
     *
     * @access public
     * @return string 
     */
    public function getVoucher()
    {
        return $this->voucher;
    }

    /**
     * Set serialNumber
     *
     * @access public
     * @param string $serialNumber
     * @return Subscription
     */
    public function setSerialNumber($serialNumber = null)
    {
        $this->serialNumber = $serialNumber;
        return $this;
    }

    /**
     * Get serialNumber
     *
     * @access public
     * @return string 
     */
    public function getSerialNumber()
    {
        return $this->serialNumber;
    }

    /**
     * Set amount
     *
     * @access public
     * @param float $amount
     * @return Subscription
     */
    public function setAmount($amount = null)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Get amount
     *
     * @access public
     * @return float 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set currency
     *
     * @access public
     * @param string $currency
     * @return Subscription
     */
    public function setCurrency($currency = null)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * Get currency
     *
     * @access public
     * @return string 
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set duration
     *
     * @access public
     * @param float $duration
     * @return Subscription
     */
    public function setDuration($duration = null)
    {
        $this->duration = $duration;
        return $this;
    }

    /**
     * Get duration
     *
     * @access public
     * @return float 
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set startDate
     *
     * @access public
     * @param \DateTime $startDate
     * @return Subscription
     */
    public function setStartDate(\DateTime $startDate = null)
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * Get startDate
     *
     * @access public
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @access public
     * @param \DateTime $endDate
     * @return Subscription
     */
    public function setEndDate(\DateTime $endDate = null)
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * Get endDate
     *
     * @access public
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set priceValue
     *
     * @access public
     * @param float $priceValue
     * @return Subscription
     */
    public function setPriceValue($priceValue = null)
    {
        $this->priceValue = $priceValue;
        return $this;
    }

    /**
     * Get priceValue
     *
     * @access public
     * @return float 
     */
    public function getPriceValue()
    {
        return $this->priceValue;
    }

    /**
     * Set userAgent
     *
     * @access public
     * @param string $userAgent
     * @return Subscription
     */
    public function setUserAgent($userAgent = null)
    {
        $this->userAgent = $userAgent;
        return $this;
    }

    /**
     * Get userAgent
     *
     * @access public
     * @return string 
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * Set createdAt
     *
     * @access public
     * @param \DateTime $createdAt
     * @return Subscription
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
     * @return Subscription
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
     * Set visit
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Visit $visit
     * @return Subscription
     */
    public function setVisit(Visit $visit = null)
    {
        $this->visit = $visit;
        return $this;
    }

    /**
     * Get visit
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Visit 
     */
    public function getVisit()
    {
        return $this->visit;
    }

    /**
     * Set package
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Package $package
     * @return Subscription
     */
    public function setPackage(Package $package = null)
    {
        $this->package = $package;
        return $this;
    }

    /**
     * Get package
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Package 
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * Set price
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Price $price
     * @return Subscription
     */
    public function setPrice(Price $price = null)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Get price
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Price 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set creatorUser
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\User $creatorUser
     * @return Subscription
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
     * @return Subscription
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
