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
 * Log Entity
 * 
 * Storing Logs data to the database using Doctrine
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
 * @see        Log
 * @since      Class available since Release 1.0
 * @deprecated Nothing
 * @access     public
 * 
 * @ORM\Table(name="`log`", indexes={@ORM\Index(name="session_id", columns={"session_id"}), @ORM\Index(name="creator_user_id", columns={"creator_user_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class Log 
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
     * @ORM\Column(name="url", type="string", length=100, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $url;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="method", type="string", length=10, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $method;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="details_before", type="text", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $detailsBefore;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="details_after", type="text", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $detailsAfter;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="note", type="text", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $note;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="ip_address", type="string", length=15, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $ipAddress;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="user_agent", type="string", length=511, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $userAgent;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="application", type="string", length=20, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $application;

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
     * @var \ContinuousNet\PubliPrBundle\Entity\Session
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Session")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="session_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $session;

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
     * Set url
     *
     * @access public
     * @param string $url
     * @return Log
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Get url
     *
     * @access public
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set method
     *
     * @access public
     * @param string $method
     * @return Log
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * Get method
     *
     * @access public
     * @return string 
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set detailsBefore
     *
     * @access public
     * @param string $detailsBefore
     * @return Log
     */
    public function setDetailsBefore($detailsBefore = null)
    {
        $this->detailsBefore = $detailsBefore;
        return $this;
    }

    /**
     * Get detailsBefore
     *
     * @access public
     * @return string 
     */
    public function getDetailsBefore()
    {
        return $this->detailsBefore;
    }

    /**
     * Set detailsAfter
     *
     * @access public
     * @param string $detailsAfter
     * @return Log
     */
    public function setDetailsAfter($detailsAfter = null)
    {
        $this->detailsAfter = $detailsAfter;
        return $this;
    }

    /**
     * Get detailsAfter
     *
     * @access public
     * @return string 
     */
    public function getDetailsAfter()
    {
        return $this->detailsAfter;
    }

    /**
     * Set note
     *
     * @access public
     * @param string $note
     * @return Log
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
     * Set ipAddress
     *
     * @access public
     * @param string $ipAddress
     * @return Log
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;
        return $this;
    }

    /**
     * Get ipAddress
     *
     * @access public
     * @return string 
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * Set userAgent
     *
     * @access public
     * @param string $userAgent
     * @return Log
     */
    public function setUserAgent($userAgent)
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
     * Set application
     *
     * @access public
     * @param string $application
     * @return Log
     */
    public function setApplication($application)
    {
        $this->application = $application;
        return $this;
    }

    /**
     * Get application
     *
     * @access public
     * @return string 
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * Set createdAt
     *
     * @access public
     * @param \DateTime $createdAt
     * @return Log
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
     * Set session
     *
     * @access public
     * @param \ContinuousNet\PubliPrBundle\Entity\Session $session
     * @return Log
     */
    public function setSession(Session $session = null)
    {
        $this->session = $session;
        return $this;
    }

    /**
     * Get session
     *
     * @access public
     * @return \ContinuousNet\PubliPrBundle\Entity\Session 
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Set creatorUser
     *
     * @access public
     * @param \ContinuousNet\PubliPrBundle\Entity\User $creatorUser
     * @return Log
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
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
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
