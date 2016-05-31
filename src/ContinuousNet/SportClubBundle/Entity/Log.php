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
 * Log Entity
 * 
 * Storing Logs data to the database using Doctrine
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
 * @see        Log
 * @since      Class available since Release 1.0
 * @access     public
 * 
 * @ORM\Table(name="`log`", indexes={@ORM\Index(name="creator_user_id", columns={"creator_user_id"})})
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
     * @ORM\Column(name="entity", type="string", length=320, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $entity;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="foreign_key", type="integer", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $foreignKey;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="action", type="string", length=320, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $action;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="ip_address", type="string", length=15, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $ipAddress;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="user_agent", type="string", length=511, nullable=true, unique=false)
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
     * Set entity
     *
     * @access public
     * @param string $entity
     * @return Log
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;
        return $this;
    }

    /**
     * Get entity
     *
     * @access public
     * @return string 
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Set foreignKey
     *
     * @access public
     * @param integer $foreignKey
     * @return Log
     */
    public function setForeignKey($foreignKey)
    {
        $this->foreignKey = $foreignKey;
        return $this;
    }

    /**
     * Get foreignKey
     *
     * @access public
     * @return integer 
     */
    public function getForeignKey()
    {
        return $this->foreignKey;
    }

    /**
     * Set action
     *
     * @access public
     * @param string $action
     * @return Log
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * Get action
     *
     * @access public
     * @return string 
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set ipAddress
     *
     * @access public
     * @param string $ipAddress
     * @return Log
     */
    public function setIpAddress($ipAddress = null)
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
     * Set creatorUser
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\User $creatorUser
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
     * @return \ContinuousNet\SportClubBundle\Entity\User 
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
