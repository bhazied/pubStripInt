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
 * Hit Entity
 * 
 * Storing Hits data to the database using Doctrine
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
 * @see        Hit
 * @since      Class available since Release 1.0
 * @access     public
 * 
 * @ORM\Table(name="`hit`", indexes={@ORM\Index(name="visit_id", columns={"visit_id"}), @ORM\Index(name="creator_user_id", columns={"creator_user_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class Hit 
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
     * @ORM\Column(name="entity", type="string", length=50, nullable=false, unique=false)
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
     * @ORM\Column(name="url", type="string", length=320, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $url;

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
     * @return Hit
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
     * @return Hit
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
     * Set url
     *
     * @access public
     * @param string $url
     * @return Hit
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
     * Set createdAt
     *
     * @access public
     * @param \DateTime $createdAt
     * @return Hit
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
     * Set visit
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Visit $visit
     * @return Hit
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
     * Set creatorUser
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\User $creatorUser
     * @return Hit
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
