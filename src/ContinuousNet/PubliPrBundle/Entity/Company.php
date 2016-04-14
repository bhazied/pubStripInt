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
 * Company Entity
 * 
 * Storing Companies data to the database using Doctrine
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
 * @see        Company
 * @since      Class available since Release 1.0
 * @deprecated Nothing
 * @access     public
 * 
 * @ORM\Table(name="`company`", indexes={@ORM\Index(name="creator_user_id", columns={"creator_user_id"}), @ORM\Index(name="modifier_user_id", columns={"modifier_user_id"})})
 * @ORM\Entity
 * @UniqueEntity("name")
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class Company 
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
     * @ORM\Column(name="name", type="string", length=320, nullable=false, unique=true)
     * 
     * @Expose
     * 
     */
    private $name;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="picture", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $picture;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="website", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $website;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="email", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $email;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="phone", type="string", length=20, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $phone;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="fax", type="string", length=20, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $fax;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="siren", type="string", length=25, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $siren;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="siret", type="string", length=25, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $siret;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="rcs", type="string", length=25, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $rcs;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="ape", type="string", length=25, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $ape;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="vat", type="string", length=25, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $vat;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $isActive;

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
     * Set name
     *
     * @access public
     * @param string $name
     * @return Company
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
     * Set picture
     *
     * @access public
     * @param string $picture
     * @return Company
     */
    public function setPicture($picture = null)
    {
        $this->picture = $picture;
        return $this;
    }

    /**
     * Get picture
     *
     * @access public
     * @return string 
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set website
     *
     * @access public
     * @param string $website
     * @return Company
     */
    public function setWebsite($website = null)
    {
        $this->website = $website;
        return $this;
    }

    /**
     * Get website
     *
     * @access public
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set email
     *
     * @access public
     * @param string $email
     * @return Company
     */
    public function setEmail($email = null)
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
     * @return Company
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
     * Set fax
     *
     * @access public
     * @param string $fax
     * @return Company
     */
    public function setFax($fax = null)
    {
        $this->fax = $fax;
        return $this;
    }

    /**
     * Get fax
     *
     * @access public
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set siren
     *
     * @access public
     * @param string $siren
     * @return Company
     */
    public function setSiren($siren)
    {
        $this->siren = $siren;
        return $this;
    }

    /**
     * Get siren
     *
     * @access public
     * @return string 
     */
    public function getSiren()
    {
        return $this->siren;
    }

    /**
     * Set siret
     *
     * @access public
     * @param string $siret
     * @return Company
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;
        return $this;
    }

    /**
     * Get siret
     *
     * @access public
     * @return string 
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * Set rcs
     *
     * @access public
     * @param string $rcs
     * @return Company
     */
    public function setRcs($rcs)
    {
        $this->rcs = $rcs;
        return $this;
    }

    /**
     * Get rcs
     *
     * @access public
     * @return string 
     */
    public function getRcs()
    {
        return $this->rcs;
    }

    /**
     * Set ape
     *
     * @access public
     * @param string $ape
     * @return Company
     */
    public function setApe($ape)
    {
        $this->ape = $ape;
        return $this;
    }

    /**
     * Get ape
     *
     * @access public
     * @return string 
     */
    public function getApe()
    {
        return $this->ape;
    }

    /**
     * Set vat
     *
     * @access public
     * @param string $vat
     * @return Company
     */
    public function setVat($vat)
    {
        $this->vat = $vat;
        return $this;
    }

    /**
     * Get vat
     *
     * @access public
     * @return string 
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * Set isActive
     *
     * @access public
     * @param boolean $isActive
     * @return Company
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * Get isActive
     *
     * @access public
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set createdAt
     *
     * @access public
     * @param \DateTime $createdAt
     * @return Company
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
     * @return Company
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
     * @return Company
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
     * @return Company
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
