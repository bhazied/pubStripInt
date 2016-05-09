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
 * Payment Entity
 * 
 * Storing Payments data to the database using Doctrine
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
 * @see        Payment
 * @since      Class available since Release 1.0
 * @deprecated Nothing
 * @access     public
 * 
 * @ORM\Table(name="`payment`", indexes={@ORM\Index(name="creator_user_id", columns={"creator_user_id"}), @ORM\Index(name="modifier_user_id", columns={"modifier_user_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class Payment 
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
     * @ORM\Column(name="ip", type="string", length=15, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $ip;

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
     * @ORM\Column(name="currency", type="string", length=3, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $currency;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="status", type="string", length=20, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $status;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="discount_code", type="string", length=20, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $discountCode;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="invoice_number", type="string", length=20, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $invoiceNumber;

    /**
     * @var array
     * @access private
     *
     * @ORM\Column(name="details", type="array", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $details;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="note", type="string", length=100, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $note;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="is_valid", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $isValid;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="token", type="text", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $token;

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
     * Set ip
     *
     * @access public
     * @param string $ip
     * @return Payment
     */
    public function setIp($ip)
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
     * Set amount
     *
     * @access public
     * @param float $amount
     * @return Payment
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
     * Set currency
     *
     * @access public
     * @param string $currency
     * @return Payment
     */
    public function setCurrency($currency)
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
     * Set status
     *
     * @access public
     * @param string $status
     * @return Payment
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
     * Set discountCode
     *
     * @access public
     * @param string $discountCode
     * @return Payment
     */
    public function setDiscountCode($discountCode = null)
    {
        $this->discountCode = $discountCode;
        return $this;
    }

    /**
     * Get discountCode
     *
     * @access public
     * @return string 
     */
    public function getDiscountCode()
    {
        return $this->discountCode;
    }

    /**
     * Set invoiceNumber
     *
     * @access public
     * @param string $invoiceNumber
     * @return Payment
     */
    public function setInvoiceNumber($invoiceNumber = null)
    {
        $this->invoiceNumber = $invoiceNumber;
        return $this;
    }

    /**
     * Get invoiceNumber
     *
     * @access public
     * @return string 
     */
    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }

    /**
     * Set details
     *
     * @access public
     * @param array $details
     * @return Payment
     */
    public function setDetails(array $details = null)
    {
        $this->details = $details;
        return $this;
    }

    /**
     * Get details
     *
     * @access public
     * @return array 
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * Set note
     *
     * @access public
     * @param string $note
     * @return Payment
     */
    public function setNote($note = null)
    {
        $this->note = $note;
        return $this;
    }

    /**
     * Get note
     *
     * @access public
     * @return string 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set isValid
     *
     * @access public
     * @param boolean $isValid
     * @return Payment
     */
    public function setIsValid($isValid)
    {
        $this->isValid = $isValid;
        return $this;
    }

    /**
     * Get isValid
     *
     * @access public
     * @return boolean 
     */
    public function getIsValid()
    {
        return $this->isValid;
    }

    /**
     * Set token
     *
     * @access public
     * @param string $token
     * @return Payment
     */
    public function setToken($token)
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
     * Set createdAt
     *
     * @access public
     * @param \DateTime $createdAt
     * @return Payment
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
     * @return Payment
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
     * @param \ContinuousNet\PubliPrBundle\Entity\User $creatorUser
     * @return Payment
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
     * @return Payment
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
