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
 * Contact Entity
 * 
 * Storing Contacts data to the database using Doctrine
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
 * @see        Contact
 * @since      Class available since Release 1.0
 * @access     public
 * 
 * @ORM\Table(name="`contact`", indexes={@ORM\Index(name="contact_group_id", columns={"contact_group_id"}), @ORM\Index(name="creator_user_id", columns={"creator_user_id"}), @ORM\Index(name="modifier_user_id", columns={"modifier_user_id"})})
 * @ORM\Entity
 * @UniqueEntity("email")
 * @UniqueEntity("phone")
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class Contact 
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
     * @ORM\Column(name="first_name", type="string", length=100, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $firstName;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="last_name", type="string", length=100, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $lastName;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="email", type="string", length=320, nullable=false, unique=true)
     * 
     * @Expose
     * 
     */
    private $email;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="phone", type="string", length=20, nullable=true, unique=true)
     * 
     * @Expose
     * 
     */
    private $phone;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="active", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $active;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="unsubscribed", type="boolean", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $unsubscribed;

    /**
     * @var \DateTime
     * @access private
     *
     * @ORM\Column(name="unsubscribed_at", type="datetime", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $unsubscribedAt;

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
     * @var \ContinuousNet\PubliPrBundle\Entity\ContactGroup
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="ContactGroup")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="contact_group_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $contactGroup;

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
     * Set firstName
     *
     * @access public
     * @param string $firstName
     * @return Contact
     */
    public function setFirstName($firstName = null)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * Get firstName
     *
     * @access public
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @access public
     * @param string $lastName
     * @return Contact
     */
    public function setLastName($lastName = null)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * Get lastName
     *
     * @access public
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set email
     *
     * @access public
     * @param string $email
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @access public
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @access public
     * @param string $phone
     * @return Contact
     */
    public function setPhone($phone = null)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Get phone
     *
     * @access public
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set active
     *
     * @access public
     * @param boolean $active
     * @return Contact
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * Get active
     *
     * @access public
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set unsubscribed
     *
     * @access public
     * @param boolean $unsubscribed
     * @return Contact
     */
    public function setUnsubscribed($unsubscribed = null)
    {
        $this->unsubscribed = $unsubscribed;
        return $this;
    }

    /**
     * Get unsubscribed
     *
     * @access public
     * @return boolean 
     */
    public function getUnsubscribed()
    {
        return $this->unsubscribed;
    }

    /**
     * Set unsubscribedAt
     *
     * @access public
     * @param \DateTime $unsubscribedAt
     * @return Contact
     */
    public function setUnsubscribedAt(\DateTime $unsubscribedAt = null)
    {
        $this->unsubscribedAt = $unsubscribedAt;
        return $this;
    }

    /**
     * Get unsubscribedAt
     *
     * @access public
     * @return \DateTime 
     */
    public function getUnsubscribedAt()
    {
        return $this->unsubscribedAt;
    }

    /**
     * Set createdAt
     *
     * @access public
     * @param \DateTime $createdAt
     * @return Contact
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
     * @return Contact
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
     * Set contactGroup
     *
     * @access public
     * @param \ContinuousNet\PubliPrBundle\Entity\ContactGroup $contactGroup
     * @return Contact
     */
    public function setContactGroup(ContactGroup $contactGroup = null)
    {
        $this->contactGroup = $contactGroup;
        return $this;
    }

    /**
     * Get contactGroup
     *
     * @access public
     * @return \ContinuousNet\PubliPrBundle\Entity\ContactGroup 
     */
    public function getContactGroup()
    {
        return $this->contactGroup;
    }

    /**
     * Set creatorUser
     *
     * @access public
     * @param \ContinuousNet\PubliPrBundle\Entity\User $creatorUser
     * @return Contact
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
     * @return Contact
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
