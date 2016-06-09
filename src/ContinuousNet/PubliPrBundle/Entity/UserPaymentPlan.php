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
 * User Payment Plan Entity
 * 
 * Storing UserPaymentPlans data to the database using Doctrine
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
 * @see        UserPaymentPlan
 * @since      Class available since Release 1.0
 * @access     public
 * 
 * @ORM\Table(name="`user_payment_plan`", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="payment_plan_id", columns={"payment_plan_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class UserPaymentPlan 
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
     * @ORM\Column(name="stripe_reference", type="string", length=50, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $stripeReference;

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
     * @ORM\Column(name="modified_at", type="datetime", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $modifiedAt;

    /**
     * @var \DateTime
     * @access private
     *
     * @ORM\Column(name="close_date", type="datetime", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $closeDate;


    /**
     * @var \ContinuousNet\PubliPrBundle\Entity\User
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $user;

    /**
     * @var \ContinuousNet\PubliPrBundle\Entity\PaymentPlan
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="PaymentPlan")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="payment_plan_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $paymentPlan;

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
     * Set stripeReference
     *
     * @access public
     * @param string $stripeReference
     * @return UserPaymentPlan
     */
    public function setStripeReference($stripeReference = null)
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
     * Set status
     *
     * @access public
     * @param string $status
     * @return UserPaymentPlan
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
     * @return UserPaymentPlan
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
     * @return UserPaymentPlan
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
     * Set closeDate
     *
     * @access public
     * @param \DateTime $closeDate
     * @return UserPaymentPlan
     */
    public function setCloseDate(\DateTime $closeDate)
    {
        $this->closeDate = $closeDate;
        return $this;
    }

    /**
     * Get closeDate
     *
     * @access public
     * @return \DateTime 
     */
    public function getCloseDate()
    {
        return $this->closeDate;
    }
    

    /**
     * Set user
     *
     * @access public
     * @param \ContinuousNet\PubliPrBundle\Entity\User $user
     * @return UserPaymentPlan
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @access public
     * @return \ContinuousNet\PubliPrBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set paymentPlan
     *
     * @access public
     * @param \ContinuousNet\PubliPrBundle\Entity\PaymentPlan $paymentPlan
     * @return UserPaymentPlan
     */
    public function setPaymentPlan(PaymentPlan $paymentPlan = null)
    {
        $this->paymentPlan = $paymentPlan;
        return $this;
    }

    /**
     * Get paymentPlan
     *
     * @access public
     * @return \ContinuousNet\PubliPrBundle\Entity\PaymentPlan 
     */
    public function getPaymentPlan()
    {
        return $this->paymentPlan;
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
