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
 * Team Entity
 * 
 * Storing Teams data to the database using Doctrine
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
 * @see        Team
 * @since      Class available since Release 1.0
 * @access     public
 * 
 * @ORM\Table(name="`team`", indexes={@ORM\Index(name="country_id", columns={"country_id"}), @ORM\Index(name="stadium_id", columns={"stadium_id"}), @ORM\Index(name="creator_user_id", columns={"creator_user_id"}), @ORM\Index(name="modifier_user_id", columns={"modifier_user_id"})})
 * @ORM\Entity
 * @UniqueEntity("name")
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class Team 
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
     * @ORM\Column(name="name_ar", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $nameAr;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="name_fr", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $nameFr;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="alias", type="string", length=320, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $alias;

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
     * @ORM\Column(name="president_name", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $presidentName;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="coach_name", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $coachName;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="fondation_year", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $fondationYear;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="address", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $address;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="zip_code", type="string", length=10, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $zipCode;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="phone", type="string", length=25, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $phone;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="fax", type="string", length=25, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $fax;

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
     * @ORM\Column(name="color", type="string", length=6, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $color;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="team_type", type="string", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $teamType;

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
     * @var string
     * @access private
     *
     * @ORM\Column(name="summary", type="text", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $summary;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="eurosport", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $eurosport;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="lequipe", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $lequipe;

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
     * @var \ContinuousNet\SportClubBundle\Entity\Country
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $country;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\Stadium
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Stadium")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="stadium_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $stadium;

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
     * @var \ContinuousNet\SportClubBundle\Entity\User
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
     * @return Team
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
     * Set nameAr
     *
     * @access public
     * @param string $nameAr
     * @return Team
     */
    public function setNameAr($nameAr = null)
    {
        $this->nameAr = $nameAr;
        return $this;
    }

    /**
     * Get nameAr
     *
     * @access public
     * @return string 
     */
    public function getNameAr()
    {
        return $this->nameAr;
    }

    /**
     * Set nameFr
     *
     * @access public
     * @param string $nameFr
     * @return Team
     */
    public function setNameFr($nameFr = null)
    {
        $this->nameFr = $nameFr;
        return $this;
    }

    /**
     * Get nameFr
     *
     * @access public
     * @return string 
     */
    public function getNameFr()
    {
        return $this->nameFr;
    }

    /**
     * Set alias
     *
     * @access public
     * @param string $alias
     * @return Team
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
        return $this;
    }

    /**
     * Get alias
     *
     * @access public
     * @return string 
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set picture
     *
     * @access public
     * @param string $picture
     * @return Team
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
     * Set presidentName
     *
     * @access public
     * @param string $presidentName
     * @return Team
     */
    public function setPresidentName($presidentName = null)
    {
        $this->presidentName = $presidentName;
        return $this;
    }

    /**
     * Get presidentName
     *
     * @access public
     * @return string 
     */
    public function getPresidentName()
    {
        return $this->presidentName;
    }

    /**
     * Set coachName
     *
     * @access public
     * @param string $coachName
     * @return Team
     */
    public function setCoachName($coachName = null)
    {
        $this->coachName = $coachName;
        return $this;
    }

    /**
     * Get coachName
     *
     * @access public
     * @return string 
     */
    public function getCoachName()
    {
        return $this->coachName;
    }

    /**
     * Set fondationYear
     *
     * @access public
     * @param integer $fondationYear
     * @return Team
     */
    public function setFondationYear($fondationYear = null)
    {
        $this->fondationYear = $fondationYear;
        return $this;
    }

    /**
     * Get fondationYear
     *
     * @access public
     * @return integer 
     */
    public function getFondationYear()
    {
        return $this->fondationYear;
    }

    /**
     * Set address
     *
     * @access public
     * @param string $address
     * @return Team
     */
    public function setAddress($address = null)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * Get address
     *
     * @access public
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set zipCode
     *
     * @access public
     * @param string $zipCode
     * @return Team
     */
    public function setZipCode($zipCode = null)
    {
        $this->zipCode = $zipCode;
        return $this;
    }

    /**
     * Get zipCode
     *
     * @access public
     * @return string 
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set phone
     *
     * @access public
     * @param string $phone
     * @return Team
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
     * @return Team
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
     * Set email
     *
     * @access public
     * @param string $email
     * @return Team
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
     * Set website
     *
     * @access public
     * @param string $website
     * @return Team
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
     * Set color
     *
     * @access public
     * @param string $color
     * @return Team
     */
    public function setColor($color = null)
    {
        $this->color = $color;
        return $this;
    }

    /**
     * Get color
     *
     * @access public
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set teamType
     *
     * @access public
     * @param string $teamType
     * @return Team
     */
    public function setTeamType($teamType)
    {
        $this->teamType = $teamType;
        return $this;
    }

    /**
     * Get teamType
     *
     * @access public
     * @return string 
     */
    public function getTeamType()
    {
        return $this->teamType;
    }

    /**
     * Set status
     *
     * @access public
     * @param string $status
     * @return Team
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
     * Set summary
     *
     * @access public
     * @param string $summary
     * @return Team
     */
    public function setSummary($summary = null)
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * Get summary
     *
     * @access public
     * @return string 
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set eurosport
     *
     * @access public
     * @param string $eurosport
     * @return Team
     */
    public function setEurosport($eurosport = null)
    {
        $this->eurosport = $eurosport;
        return $this;
    }

    /**
     * Get eurosport
     *
     * @access public
     * @return string 
     */
    public function getEurosport()
    {
        return $this->eurosport;
    }

    /**
     * Set lequipe
     *
     * @access public
     * @param string $lequipe
     * @return Team
     */
    public function setLequipe($lequipe = null)
    {
        $this->lequipe = $lequipe;
        return $this;
    }

    /**
     * Get lequipe
     *
     * @access public
     * @return string 
     */
    public function getLequipe()
    {
        return $this->lequipe;
    }

    /**
     * Set createdAt
     *
     * @access public
     * @param \DateTime $createdAt
     * @return Team
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
     * @return Team
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
     * Set country
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Country $country
     * @return Team
     */
    public function setCountry(Country $country = null)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * Get country
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set stadium
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Stadium $stadium
     * @return Team
     */
    public function setStadium(Stadium $stadium = null)
    {
        $this->stadium = $stadium;
        return $this;
    }

    /**
     * Get stadium
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Stadium 
     */
    public function getStadium()
    {
        return $this->stadium;
    }

    /**
     * Set creatorUser
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\User $creatorUser
     * @return Team
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
     * Set modifierUser
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\User $modifierUser
     * @return Team
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
     * @return \ContinuousNet\SportClubBundle\Entity\User 
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
