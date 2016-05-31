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
 * Email Campaign Entity
 * 
 * Storing EmailCampaigns data to the database using Doctrine
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
 * @see        EmailCampaign
 * @since      Class available since Release 1.0
 * @access     public
 * 
 * @ORM\Table(name="`email_campaign`", indexes={@ORM\Index(name="press_release_id", columns={"press_release_id"}), @ORM\Index(name="creator_user_id", columns={"creator_user_id"}), @ORM\Index(name="modifier_user_id", columns={"modifier_user_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class EmailCampaign 
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
     * @ORM\Column(name="name", type="string", length=320, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $name;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="description", type="text", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $description;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="send_now", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $sendNow;

    /**
     * @var \DateTime
     * @access private
     *
     * @ORM\Column(name="sending_date_time", type="datetime", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $sendingDateTime;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="external_reference", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $externalReference;

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
     * @var \ContinuousNet\PubliPrBundle\Entity\PressRelease
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="PressRelease")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="press_release_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $pressRelease;

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
     * @var \Doctrine\Common\Collections\Collection
     * @access private
     *
     * @ORM\ManyToMany(targetEntity="ContactGroup", inversedBy="emailCampaigns")
     * @ORM\JoinTable(name="email_campaigns_contact_groups",
     *     joinColumns={
     *         @ORM\JoinColumn(name="email_campaign_id", referencedColumnName="id")
     *     },
     *     inverseJoinColumns={
     *         @ORM\JoinColumn(name="contact_group_id", referencedColumnName="id")
     *     }
     * )
     * 
     * @Expose
     * @MaxDepth(2)
     * 
     */
    private $contactGroups;

    /**
     * Constructor
     * 
     * @access public
     */
    public function __construct()
    {
        $this->contactGroups = new DoctrineCollection();
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
     * @return EmailCampaign
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
     * Set description
     *
     * @access public
     * @param string $description
     * @return EmailCampaign
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @access public
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set sendNow
     *
     * @access public
     * @param boolean $sendNow
     * @return EmailCampaign
     */
    public function setSendNow($sendNow)
    {
        $this->sendNow = $sendNow;
        return $this;
    }

    /**
     * Get sendNow
     *
     * @access public
     * @return boolean 
     */
    public function getSendNow()
    {
        return $this->sendNow;
    }

    /**
     * Set sendingDateTime
     *
     * @access public
     * @param \DateTime $sendingDateTime
     * @return EmailCampaign
     */
    public function setSendingDateTime(\DateTime $sendingDateTime = null)
    {
        $this->sendingDateTime = $sendingDateTime;
        return $this;
    }

    /**
     * Get sendingDateTime
     *
     * @access public
     * @return \DateTime 
     */
    public function getSendingDateTime()
    {
        return $this->sendingDateTime;
    }

    /**
     * Set externalReference
     *
     * @access public
     * @param string $externalReference
     * @return EmailCampaign
     */
    public function setExternalReference($externalReference = null)
    {
        $this->externalReference = $externalReference;
        return $this;
    }

    /**
     * Get externalReference
     *
     * @access public
     * @return string 
     */
    public function getExternalReference()
    {
        return $this->externalReference;
    }

    /**
     * Set createdAt
     *
     * @access public
     * @param \DateTime $createdAt
     * @return EmailCampaign
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
     * @return EmailCampaign
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
     * Set pressRelease
     *
     * @access public
     * @param \ContinuousNet\PubliPrBundle\Entity\PressRelease $pressRelease
     * @return EmailCampaign
     */
    public function setPressRelease(PressRelease $pressRelease = null)
    {
        $this->pressRelease = $pressRelease;
        return $this;
    }

    /**
     * Get pressRelease
     *
     * @access public
     * @return \ContinuousNet\PubliPrBundle\Entity\PressRelease 
     */
    public function getPressRelease()
    {
        return $this->pressRelease;
    }

    /**
     * Set creatorUser
     *
     * @access public
     * @param \ContinuousNet\PubliPrBundle\Entity\User $creatorUser
     * @return EmailCampaign
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
     * @return EmailCampaign
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
     * Add contactGroup
     *
     * @access public
     * @param ContactGroup $contactGroup
     * @return EmailCampaign
     */
    public function addContactGroup(ContactGroup $contactGroup)
    {
        if (!$this->contactGroups->contains($contactGroup))
        {
            $this->contactGroups->add($contactGroup);
        }
        return $this;
    }

    /**
     * Remove contactGroup
     *
     * @access public
     * @param ContactGroup $contactGroup
     * @return EmailCampaign
     */
    public function removeContactGroup(ContactGroup $contactGroup)
    {
        if ($this->contactGroups->contains($contactGroup))
        {
            $this->contactGroups->removeElement($contactGroup);
        }
        return $this;
    }

    /**
     * Set contactGroup
     *
     * @access public
     * @param \Doctrine\Common\Collections\Collection
     * @return EmailCampaign
     */
    public function setContactGroups($contactGroups)
    {
        $this->contactGroups = $contactGroups;
        return $this;
    }

    /**
     * Get contactGroup
     *
     * @access public
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContactGroups()
    {
        return $this->contactGroups;
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
