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
 * Subscription Entity
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
 * @access     public
 *
 * @ORM\Table(name="`subscription`", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="payment_id", columns={"payment_id"})})
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
     * @var \ContinuousNet\PubliPrBundle\Entity\User
     * @access private
     *
     *@ORM\ManyToOne(targetEntity="User")
     *@ORM\JoinColumns({
     *        @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     * @Expose
     * @MaxDepth(1)
     *
     */
    private $user;

    /**
     * @var \ContinuousNet\PubliPrBundle\Entity\Payment
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Payment")
     *@ORM\JoinColumns({
     *        @ORM\JoinColumn(name="payment_id", referencedColumnName="id")
     * })
     * @Expose
     * @MaxDepth(1)
     *
     */
    private $payment;

    /**
     * @var \DateTime
     * @access private
     *
     * @ORM\Column(name="start_date", type="datetime", nullable=false, unique=false)
     *
     * @Expose
     * @MaxDepth(1)
     *
     */
    private $startDate;

    /**
     * @var \DateTime
     * @access private
     *
     * @ORM\Column(name="end_date", type="datetime", nullable=false, unique=false)
     *
     * @Expose
     * @MaxDepth(1)
     *
     */
    private $endDate;

    /**
     * @var \DateTime
     * @access private
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false, unique=false)
     *
     * @Expose
     * @MaxDepth(1)
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
     * Set user
     *
     * @access public
     * @param \ContinuousNet\PubliPrBundle\Entity\User $user
     * @return Subscription
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get ip
     *
     * @access public
     * @return \ContinuousNet\PubliPrBundle\Entity\User $user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set payment
     *
     * @access public
     * @param \ContinuousNet\PubliPrBundle\Entity\Payment $payment
     * @return Subscription
     */
    public function setPayement(Payment $payement = null)
    {
        $this->setPayement = $payement;
        return $this;
    }

    /**
     * Get payment
     *
     * @access public
     * @return \ContinuousNet\PubliPrBundle\Entity\Payment $payement
     */
    public function getAmount()
    {
        return $this->payment;
    }

    /**
     * Set startDate
     *
     * @access public
     * @param \DateTime $createdAt
     * @return Subscription
     */
    public function setStartDate(\DateTime $startDate)
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
     * Set startDate
     *
     * @access public
     * @param \DateTime $createdAt
     * @return Subscription
     */
    public function setEndDate(\DateTime $endDate)
    {
        $this->startDate = $endDate;
        return $this;
    }

    /**
     * Get startDate
     *
     * @access public
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
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
