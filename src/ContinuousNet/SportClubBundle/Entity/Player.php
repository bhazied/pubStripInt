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
 * Player Entity
 * 
 * Storing Players data to the database using Doctrine
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
 * @see        Player
 * @since      Class available since Release 1.0
 * @access     public
 * 
 * @ORM\Table(name="`player`", indexes={@ORM\Index(name="birth_country_id", columns={"birth_country_id"}), @ORM\Index(name="nationality_country_id", columns={"nationality_country_id"}), @ORM\Index(name="team_id_club", columns={"team_id_club"}), @ORM\Index(name="team_id_national", columns={"team_id_national"}), @ORM\Index(name="creator_user_id", columns={"creator_user_id"}), @ORM\Index(name="modifier_user_id", columns={"modifier_user_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class Player 
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
     * @var integer
     * @access private
     *
     * @ORM\Column(name="ordering", type="integer", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $ordering;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="position", type="string", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $position;

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
     * @ORM\Column(name="first_name", type="string", length=320, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $firstName;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="first_name_ar", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $firstNameAr;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="first_name_fr", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $firstNameFr;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="last_name", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $lastName;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="last_name_ar", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $lastNameAr;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="last_name_fr", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $lastNameFr;

    /**
     * @var \DateTime
     * @access private
     *
     * @ORM\Column(name="birth_date", type="date", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $birthDate;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="birth_place", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $birthPlace;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="birth_place_ar", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $birthPlaceAr;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="birth_place_fr", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $birthPlaceFr;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="height", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $height;

    /**
     * @var float
     * @access private
     *
     * @ORM\Column(name="weight", type="float", precision=10, scale=0, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $weight;

    /**
     * @var float
     * @access private
     *
     * @ORM\Column(name="shoe_size", type="float", precision=10, scale=0, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $shoeSize;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="writing_hand", type="string", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $writingHand;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="stronger_foot", type="string", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $strongerFoot;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="marital_status", type="string", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $maritalStatus;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="wives_names", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $wivesNames;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="sons_names", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $sonsNames;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="daughters_names", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $daughtersNames;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="father_name", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $fatherName;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="mother_name", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $motherName;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="brothers_names", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $brothersNames;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="sisters_names", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $sistersNames;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="education", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $education;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="personal_attributes", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $personalAttributes;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="hobbies", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $hobbies;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="favourite_food", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $favouriteFood;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="favourite_drink", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $favouriteDrink;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="first_replica_kit", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $firstReplicaKit;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="tv_show_rarely_miss", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $tvShowRarelyMiss;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="team_club_number", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $teamClubNumber;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="team_national_number", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $teamNationalNumber;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="personal_biography", type="text", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $personalBiography;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="technical_profile", type="text", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $technicalProfile;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="facebook", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $facebook;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="twitter", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $twitter;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="website", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $website;

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
     *        @ORM\JoinColumn(name="birth_country_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $birthCountry;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\Country
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="nationality_country_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $nationalityCountry;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\Team
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="team_id_club", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $teamClub;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\Team
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="team_id_national", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $teamNational;

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
     * Set ordering
     *
     * @access public
     * @param integer $ordering
     * @return Player
     */
    public function setOrdering($ordering)
    {
        $this->ordering = $ordering;
        return $this;
    }

    /**
     * Get ordering
     *
     * @access public
     * @return integer 
     */
    public function getOrdering()
    {
        return $this->ordering;
    }

    /**
     * Set position
     *
     * @access public
     * @param string $position
     * @return Player
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }

    /**
     * Get position
     *
     * @access public
     * @return string 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set name
     *
     * @access public
     * @param string $name
     * @return Player
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
     * @return Player
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
     * @return Player
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
     * Set picture
     *
     * @access public
     * @param string $picture
     * @return Player
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
     * Set firstName
     *
     * @access public
     * @param string $firstName
     * @return Player
     */
    public function setFirstName($firstName)
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
     * Set firstNameAr
     *
     * @access public
     * @param string $firstNameAr
     * @return Player
     */
    public function setFirstNameAr($firstNameAr = null)
    {
        $this->firstNameAr = $firstNameAr;
        return $this;
    }

    /**
     * Get firstNameAr
     *
     * @access public
     * @return string 
     */
    public function getFirstNameAr()
    {
        return $this->firstNameAr;
    }

    /**
     * Set firstNameFr
     *
     * @access public
     * @param string $firstNameFr
     * @return Player
     */
    public function setFirstNameFr($firstNameFr = null)
    {
        $this->firstNameFr = $firstNameFr;
        return $this;
    }

    /**
     * Get firstNameFr
     *
     * @access public
     * @return string 
     */
    public function getFirstNameFr()
    {
        return $this->firstNameFr;
    }

    /**
     * Set lastName
     *
     * @access public
     * @param string $lastName
     * @return Player
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
     * Set lastNameAr
     *
     * @access public
     * @param string $lastNameAr
     * @return Player
     */
    public function setLastNameAr($lastNameAr = null)
    {
        $this->lastNameAr = $lastNameAr;
        return $this;
    }

    /**
     * Get lastNameAr
     *
     * @access public
     * @return string 
     */
    public function getLastNameAr()
    {
        return $this->lastNameAr;
    }

    /**
     * Set lastNameFr
     *
     * @access public
     * @param string $lastNameFr
     * @return Player
     */
    public function setLastNameFr($lastNameFr = null)
    {
        $this->lastNameFr = $lastNameFr;
        return $this;
    }

    /**
     * Get lastNameFr
     *
     * @access public
     * @return string 
     */
    public function getLastNameFr()
    {
        return $this->lastNameFr;
    }

    /**
     * Set birthDate
     *
     * @access public
     * @param \DateTime $birthDate
     * @return Player
     */
    public function setBirthDate(\DateTime $birthDate = null)
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    /**
     * Get birthDate
     *
     * @access public
     * @return \DateTime 
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set birthPlace
     *
     * @access public
     * @param string $birthPlace
     * @return Player
     */
    public function setBirthPlace($birthPlace = null)
    {
        $this->birthPlace = $birthPlace;
        return $this;
    }

    /**
     * Get birthPlace
     *
     * @access public
     * @return string 
     */
    public function getBirthPlace()
    {
        return $this->birthPlace;
    }

    /**
     * Set birthPlaceAr
     *
     * @access public
     * @param string $birthPlaceAr
     * @return Player
     */
    public function setBirthPlaceAr($birthPlaceAr = null)
    {
        $this->birthPlaceAr = $birthPlaceAr;
        return $this;
    }

    /**
     * Get birthPlaceAr
     *
     * @access public
     * @return string 
     */
    public function getBirthPlaceAr()
    {
        return $this->birthPlaceAr;
    }

    /**
     * Set birthPlaceFr
     *
     * @access public
     * @param string $birthPlaceFr
     * @return Player
     */
    public function setBirthPlaceFr($birthPlaceFr = null)
    {
        $this->birthPlaceFr = $birthPlaceFr;
        return $this;
    }

    /**
     * Get birthPlaceFr
     *
     * @access public
     * @return string 
     */
    public function getBirthPlaceFr()
    {
        return $this->birthPlaceFr;
    }

    /**
     * Set height
     *
     * @access public
     * @param integer $height
     * @return Player
     */
    public function setHeight($height = null)
    {
        $this->height = $height;
        return $this;
    }

    /**
     * Get height
     *
     * @access public
     * @return integer 
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set weight
     *
     * @access public
     * @param float $weight
     * @return Player
     */
    public function setWeight($weight = null)
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * Get weight
     *
     * @access public
     * @return float 
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set shoeSize
     *
     * @access public
     * @param float $shoeSize
     * @return Player
     */
    public function setShoeSize($shoeSize = null)
    {
        $this->shoeSize = $shoeSize;
        return $this;
    }

    /**
     * Get shoeSize
     *
     * @access public
     * @return float 
     */
    public function getShoeSize()
    {
        return $this->shoeSize;
    }

    /**
     * Set writingHand
     *
     * @access public
     * @param string $writingHand
     * @return Player
     */
    public function setWritingHand($writingHand = null)
    {
        $this->writingHand = $writingHand;
        return $this;
    }

    /**
     * Get writingHand
     *
     * @access public
     * @return string 
     */
    public function getWritingHand()
    {
        return $this->writingHand;
    }

    /**
     * Set strongerFoot
     *
     * @access public
     * @param string $strongerFoot
     * @return Player
     */
    public function setStrongerFoot($strongerFoot = null)
    {
        $this->strongerFoot = $strongerFoot;
        return $this;
    }

    /**
     * Get strongerFoot
     *
     * @access public
     * @return string 
     */
    public function getStrongerFoot()
    {
        return $this->strongerFoot;
    }

    /**
     * Set maritalStatus
     *
     * @access public
     * @param string $maritalStatus
     * @return Player
     */
    public function setMaritalStatus($maritalStatus = null)
    {
        $this->maritalStatus = $maritalStatus;
        return $this;
    }

    /**
     * Get maritalStatus
     *
     * @access public
     * @return string 
     */
    public function getMaritalStatus()
    {
        return $this->maritalStatus;
    }

    /**
     * Set wivesNames
     *
     * @access public
     * @param string $wivesNames
     * @return Player
     */
    public function setWivesNames($wivesNames = null)
    {
        $this->wivesNames = $wivesNames;
        return $this;
    }

    /**
     * Get wivesNames
     *
     * @access public
     * @return string 
     */
    public function getWivesNames()
    {
        return $this->wivesNames;
    }

    /**
     * Set sonsNames
     *
     * @access public
     * @param string $sonsNames
     * @return Player
     */
    public function setSonsNames($sonsNames = null)
    {
        $this->sonsNames = $sonsNames;
        return $this;
    }

    /**
     * Get sonsNames
     *
     * @access public
     * @return string 
     */
    public function getSonsNames()
    {
        return $this->sonsNames;
    }

    /**
     * Set daughtersNames
     *
     * @access public
     * @param string $daughtersNames
     * @return Player
     */
    public function setDaughtersNames($daughtersNames = null)
    {
        $this->daughtersNames = $daughtersNames;
        return $this;
    }

    /**
     * Get daughtersNames
     *
     * @access public
     * @return string 
     */
    public function getDaughtersNames()
    {
        return $this->daughtersNames;
    }

    /**
     * Set fatherName
     *
     * @access public
     * @param string $fatherName
     * @return Player
     */
    public function setFatherName($fatherName = null)
    {
        $this->fatherName = $fatherName;
        return $this;
    }

    /**
     * Get fatherName
     *
     * @access public
     * @return string 
     */
    public function getFatherName()
    {
        return $this->fatherName;
    }

    /**
     * Set motherName
     *
     * @access public
     * @param string $motherName
     * @return Player
     */
    public function setMotherName($motherName = null)
    {
        $this->motherName = $motherName;
        return $this;
    }

    /**
     * Get motherName
     *
     * @access public
     * @return string 
     */
    public function getMotherName()
    {
        return $this->motherName;
    }

    /**
     * Set brothersNames
     *
     * @access public
     * @param string $brothersNames
     * @return Player
     */
    public function setBrothersNames($brothersNames = null)
    {
        $this->brothersNames = $brothersNames;
        return $this;
    }

    /**
     * Get brothersNames
     *
     * @access public
     * @return string 
     */
    public function getBrothersNames()
    {
        return $this->brothersNames;
    }

    /**
     * Set sistersNames
     *
     * @access public
     * @param string $sistersNames
     * @return Player
     */
    public function setSistersNames($sistersNames = null)
    {
        $this->sistersNames = $sistersNames;
        return $this;
    }

    /**
     * Get sistersNames
     *
     * @access public
     * @return string 
     */
    public function getSistersNames()
    {
        return $this->sistersNames;
    }

    /**
     * Set education
     *
     * @access public
     * @param string $education
     * @return Player
     */
    public function setEducation($education = null)
    {
        $this->education = $education;
        return $this;
    }

    /**
     * Get education
     *
     * @access public
     * @return string 
     */
    public function getEducation()
    {
        return $this->education;
    }

    /**
     * Set personalAttributes
     *
     * @access public
     * @param string $personalAttributes
     * @return Player
     */
    public function setPersonalAttributes($personalAttributes = null)
    {
        $this->personalAttributes = $personalAttributes;
        return $this;
    }

    /**
     * Get personalAttributes
     *
     * @access public
     * @return string 
     */
    public function getPersonalAttributes()
    {
        return $this->personalAttributes;
    }

    /**
     * Set hobbies
     *
     * @access public
     * @param string $hobbies
     * @return Player
     */
    public function setHobbies($hobbies = null)
    {
        $this->hobbies = $hobbies;
        return $this;
    }

    /**
     * Get hobbies
     *
     * @access public
     * @return string 
     */
    public function getHobbies()
    {
        return $this->hobbies;
    }

    /**
     * Set favouriteFood
     *
     * @access public
     * @param string $favouriteFood
     * @return Player
     */
    public function setFavouriteFood($favouriteFood = null)
    {
        $this->favouriteFood = $favouriteFood;
        return $this;
    }

    /**
     * Get favouriteFood
     *
     * @access public
     * @return string 
     */
    public function getFavouriteFood()
    {
        return $this->favouriteFood;
    }

    /**
     * Set favouriteDrink
     *
     * @access public
     * @param string $favouriteDrink
     * @return Player
     */
    public function setFavouriteDrink($favouriteDrink = null)
    {
        $this->favouriteDrink = $favouriteDrink;
        return $this;
    }

    /**
     * Get favouriteDrink
     *
     * @access public
     * @return string 
     */
    public function getFavouriteDrink()
    {
        return $this->favouriteDrink;
    }

    /**
     * Set firstReplicaKit
     *
     * @access public
     * @param string $firstReplicaKit
     * @return Player
     */
    public function setFirstReplicaKit($firstReplicaKit = null)
    {
        $this->firstReplicaKit = $firstReplicaKit;
        return $this;
    }

    /**
     * Get firstReplicaKit
     *
     * @access public
     * @return string 
     */
    public function getFirstReplicaKit()
    {
        return $this->firstReplicaKit;
    }

    /**
     * Set tvShowRarelyMiss
     *
     * @access public
     * @param string $tvShowRarelyMiss
     * @return Player
     */
    public function setTvShowRarelyMiss($tvShowRarelyMiss = null)
    {
        $this->tvShowRarelyMiss = $tvShowRarelyMiss;
        return $this;
    }

    /**
     * Get tvShowRarelyMiss
     *
     * @access public
     * @return string 
     */
    public function getTvShowRarelyMiss()
    {
        return $this->tvShowRarelyMiss;
    }

    /**
     * Set teamClubNumber
     *
     * @access public
     * @param integer $teamClubNumber
     * @return Player
     */
    public function setTeamClubNumber($teamClubNumber = null)
    {
        $this->teamClubNumber = $teamClubNumber;
        return $this;
    }

    /**
     * Get teamClubNumber
     *
     * @access public
     * @return integer 
     */
    public function getTeamClubNumber()
    {
        return $this->teamClubNumber;
    }

    /**
     * Set teamNationalNumber
     *
     * @access public
     * @param integer $teamNationalNumber
     * @return Player
     */
    public function setTeamNationalNumber($teamNationalNumber = null)
    {
        $this->teamNationalNumber = $teamNationalNumber;
        return $this;
    }

    /**
     * Get teamNationalNumber
     *
     * @access public
     * @return integer 
     */
    public function getTeamNationalNumber()
    {
        return $this->teamNationalNumber;
    }

    /**
     * Set personalBiography
     *
     * @access public
     * @param string $personalBiography
     * @return Player
     */
    public function setPersonalBiography($personalBiography = null)
    {
        $this->personalBiography = $personalBiography;
        return $this;
    }

    /**
     * Get personalBiography
     *
     * @access public
     * @return string 
     */
    public function getPersonalBiography()
    {
        return $this->personalBiography;
    }

    /**
     * Set technicalProfile
     *
     * @access public
     * @param string $technicalProfile
     * @return Player
     */
    public function setTechnicalProfile($technicalProfile = null)
    {
        $this->technicalProfile = $technicalProfile;
        return $this;
    }

    /**
     * Get technicalProfile
     *
     * @access public
     * @return string 
     */
    public function getTechnicalProfile()
    {
        return $this->technicalProfile;
    }

    /**
     * Set facebook
     *
     * @access public
     * @param string $facebook
     * @return Player
     */
    public function setFacebook($facebook = null)
    {
        $this->facebook = $facebook;
        return $this;
    }

    /**
     * Get facebook
     *
     * @access public
     * @return string 
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set twitter
     *
     * @access public
     * @param string $twitter
     * @return Player
     */
    public function setTwitter($twitter = null)
    {
        $this->twitter = $twitter;
        return $this;
    }

    /**
     * Get twitter
     *
     * @access public
     * @return string 
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set website
     *
     * @access public
     * @param string $website
     * @return Player
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
     * Set status
     *
     * @access public
     * @param string $status
     * @return Player
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
     * Set eurosport
     *
     * @access public
     * @param string $eurosport
     * @return Player
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
     * @return Player
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
     * @return Player
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
     * @return Player
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
     * Set birthCountry
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Country $birthCountry
     * @return Player
     */
    public function setBirthCountry(Country $birthCountry = null)
    {
        $this->birthCountry = $birthCountry;
        return $this;
    }

    /**
     * Get birthCountry
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Country 
     */
    public function getBirthCountry()
    {
        return $this->birthCountry;
    }

    /**
     * Set nationalityCountry
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Country $nationalityCountry
     * @return Player
     */
    public function setNationalityCountry(Country $nationalityCountry = null)
    {
        $this->nationalityCountry = $nationalityCountry;
        return $this;
    }

    /**
     * Get nationalityCountry
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Country 
     */
    public function getNationalityCountry()
    {
        return $this->nationalityCountry;
    }

    /**
     * Set teamClub
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Team $teamClub
     * @return Player
     */
    public function setTeamClub(Team $teamClub = null)
    {
        $this->teamClub = $teamClub;
        return $this;
    }

    /**
     * Get teamClub
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Team 
     */
    public function getTeamClub()
    {
        return $this->teamClub;
    }

    /**
     * Set teamNational
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Team $teamNational
     * @return Player
     */
    public function setTeamNational(Team $teamNational = null)
    {
        $this->teamNational = $teamNational;
        return $this;
    }

    /**
     * Get teamNational
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Team 
     */
    public function getTeamNational()
    {
        return $this->teamNational;
    }

    /**
     * Set creatorUser
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\User $creatorUser
     * @return Player
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
     * @return Player
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
