<?php

namespace ContinuousNet\PubliPrBundle\Entity;

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
 * Payment Plan Entity
 * 
 * Storing PaymentPlans data to the database using Doctrine
 * 
 * PHP version 5.4.4
 * 
 * @category   Doctrine 2 Entity
 * @package    ContinuousNet\PubliPrBundle\Entity
 * @author     Sahbi KHALFALLAH <sahbi.khalfallah@continuousnet.com>
 * @copyright  2016 CONTINUOUS NET
 * @license	CONTINUOUS NET REGULAR LICENSE
 * @version    Release: 1.0
 * @link       http://publipr.continuousnet.com/ContinuousNet/PubliPrBundle/Entity
 * @see        PaymentPlan
 * @since      Class available since Release 1.0
 * @access     public
 * 
 * @ORM\Table(name="`payment_plan`", indexes={@ORM\Index(name="creator_user_id", columns={"creator_user_id"}), @ORM\Index(name="modifier_user_id", columns={"modifier_user_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class PaymentPlan 
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
     * @ORM\Column(name="name", type="string", length=20, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $name;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="stripe_reference", type="string", length=50, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $stripeReference;

    /**
     * @var float
     * @access private
     *
     * @ORM\Column(name="amount", type="float", precision=10, scale=0, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $amount;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="interval", type="string", length=50, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $interval;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="interval_count", type="integer", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $intervalCount;

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
     * @var integer
     * @access private
     *
     * @ORM\Column(name="start_date", type="integer", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $startDate;

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
     * @ORM\Column(name="modified_at", type="datetime", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $modifiedAt;

    /**
     * @var \ContinuousNet\PubliPrBundle\Entity\User
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
     * @var \ContinuousNet\PubliPrBundle\Entity\User
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
     * @return PaymentPlan
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
     * Set stripeReference
     *
     * @access public
     * @param string $stripeReference
     * @return PaymentPlan
     */
    public function setStripeReference($stripeReference)
    {
        $this->stripeReference = $stripeReference;
        return $this;
    }

    /**
     * Get stripeReference
     *
     * @access public
     * @return string 
     */
    public function getStripeReference()
    {
        return $this->stripeReference;
    }

    /**
     * Set amount
     *
     * @access public
     * @param float $amount
     * @return PaymentPlan
     */
    public function setAmount($amount)
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
     * Set interval
     *
     * @access public
     * @param string $interval
     * @return PaymentPlan
     */
    public function setInterval($interval)
    {
        $this->interval = $interval;
        return $this;
    }

    /**
     * Get interval
     *
     * @access public
     * @return string 
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * Set intervalCount
     *
     * @access public
     * @param integer $intervalCount
     * @return PaymentPlan
     */
    public function setIntervalCount($intervalCount)
    {
        $this->intervalCount = $intervalCount;
        return $this;
    }

    /**
     * Get intervalCount
     *
     * @access public
     * @return integer 
     */
    public function getIntervalCount()
    {
        return $this->intervalCount;
    }

    /**
     * Set status
     *
     * @access public
     * @param string $status
     * @return PaymentPlan
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
     * Set startDate
     *
     * @access public
     * @param integer $startDate
     * @return PaymentPlan
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * Get startDate
     *
     * @access public
     * @return integer 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set createdAt
     *
     * @access public
     * @param \DateTime $createdAt
     * @return PaymentPlan
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
     * @return PaymentPlan
     */
    public function setModifiedAt(\DateTime $modifiedAt)
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
     * @param \ContinuousNet\PubliPrBundle\Entity\User $creatorUser
     * @return PaymentPlan
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
     * @return \ContinuousNet\PubliPrBundle\Entity\User 
     */
    public function getCreatorUser()
    {
        return $this->creatorUser;
    }

    /**
     * Set modifierUser
     *
     * @access public
     * @param \ContinuousNet\PubliPrBundle\Entity\User $modifierUser
     * @return PaymentPlan
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
     * @return \ContinuousNet\PubliPrBundle\Entity\User 
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
