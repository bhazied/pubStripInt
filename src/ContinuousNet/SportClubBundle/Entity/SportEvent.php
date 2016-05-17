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
 * Sport Event Entity
 * 
 * Storing SportEvents data to the database using Doctrine
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
 * @see        SportEvent
 * @since      Class available since Release 1.0
 * @access     public
 * 
 * @ORM\Table(name="`sport_event`", indexes={@ORM\Index(name="sport_id", columns={"sport_id"}), @ORM\Index(name="season_id", columns={"season_id"}), @ORM\Index(name="post_type_id", columns={"post_type_id"}), @ORM\Index(name="post_category_id", columns={"post_category_id"}), @ORM\Index(name="country_id", columns={"country_id"}), @ORM\Index(name="creator_user_id", columns={"creator_user_id"}), @ORM\Index(name="modifier_user_id", columns={"modifier_user_id"})})
 * @ORM\Entity
 * @UniqueEntity("name")
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class SportEvent 
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
     * @ORM\Column(name="slug", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $slug;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="slug_ar", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $slugAr;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="slug_fr", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $slugFr;

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
     * @ORM\Column(name="alias_ar", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $aliasAr;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="alias_fr", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $aliasFr;

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
     * @ORM\Column(name="team_type", type="string", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $teamType;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="enable_calendar", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $enableCalendar;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="enable_live", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $enableLive;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="enable_table", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $enableTable;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="enable_results", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $enableResults;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="enable_teams", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $enableTeams;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="enable_scorers", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $enableScorers;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="enable_stadia", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $enableStadia;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="enable_prize_winners", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $enablePrizeWinners;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="enable_statistics", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $enableStatistics;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="enable_line_up", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $enableLineUp;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="enable_posts", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $enablePosts;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="enable_videos", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $enableVideos;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="enable_images", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $enableImages;

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
     * @var \ContinuousNet\SportClubBundle\Entity\Sport
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Sport")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="sport_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $sport;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\Season
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Season")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="season_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $season;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\PostType
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="PostType")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="post_type_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $postType;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\PostCategory
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="PostCategory")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="post_category_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $postCategory;

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
     * @var \Doctrine\Common\Collections\Collection
     * @access private
     *
     * @ORM\ManyToMany(targetEntity="Team", inversedBy="sportEvents")
     * @ORM\JoinTable(name="sport_events_teams",
     *     joinColumns={
     *         @ORM\JoinColumn(name="sport_event_id", referencedColumnName="id")
     *     },
     *     inverseJoinColumns={
     *         @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     *     }
     * )
     * 
     * @Expose
     * @MaxDepth(2)
     * 
     */
    private $teams;

    /**
     * Constructor
     * 
     * @access public
     */
    public function __construct()
    {
        $this->teams = new DoctrineCollection();
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
     * @return SportEvent
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
     * @return SportEvent
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
     * @return SportEvent
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
     * Set slug
     *
     * @access public
     * @param string $slug
     * @return SportEvent
     */
    public function setSlug($slug = null)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Get slug
     *
     * @access public
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slugAr
     *
     * @access public
     * @param string $slugAr
     * @return SportEvent
     */
    public function setSlugAr($slugAr = null)
    {
        $this->slugAr = $slugAr;
        return $this;
    }

    /**
     * Get slugAr
     *
     * @access public
     * @return string 
     */
    public function getSlugAr()
    {
        return $this->slugAr;
    }

    /**
     * Set slugFr
     *
     * @access public
     * @param string $slugFr
     * @return SportEvent
     */
    public function setSlugFr($slugFr = null)
    {
        $this->slugFr = $slugFr;
        return $this;
    }

    /**
     * Get slugFr
     *
     * @access public
     * @return string 
     */
    public function getSlugFr()
    {
        return $this->slugFr;
    }

    /**
     * Set picture
     *
     * @access public
     * @param string $picture
     * @return SportEvent
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
     * Set alias
     *
     * @access public
     * @param string $alias
     * @return SportEvent
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
     * Set aliasAr
     *
     * @access public
     * @param string $aliasAr
     * @return SportEvent
     */
    public function setAliasAr($aliasAr = null)
    {
        $this->aliasAr = $aliasAr;
        return $this;
    }

    /**
     * Get aliasAr
     *
     * @access public
     * @return string 
     */
    public function getAliasAr()
    {
        return $this->aliasAr;
    }

    /**
     * Set aliasFr
     *
     * @access public
     * @param string $aliasFr
     * @return SportEvent
     */
    public function setAliasFr($aliasFr = null)
    {
        $this->aliasFr = $aliasFr;
        return $this;
    }

    /**
     * Get aliasFr
     *
     * @access public
     * @return string 
     */
    public function getAliasFr()
    {
        return $this->aliasFr;
    }

    /**
     * Set ordering
     *
     * @access public
     * @param integer $ordering
     * @return SportEvent
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
     * Set teamType
     *
     * @access public
     * @param string $teamType
     * @return SportEvent
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
     * Set enableCalendar
     *
     * @access public
     * @param boolean $enableCalendar
     * @return SportEvent
     */
    public function setEnableCalendar($enableCalendar)
    {
        $this->enableCalendar = $enableCalendar;
        return $this;
    }

    /**
     * Get enableCalendar
     *
     * @access public
     * @return boolean 
     */
    public function getEnableCalendar()
    {
        return $this->enableCalendar;
    }

    /**
     * Set enableLive
     *
     * @access public
     * @param boolean $enableLive
     * @return SportEvent
     */
    public function setEnableLive($enableLive)
    {
        $this->enableLive = $enableLive;
        return $this;
    }

    /**
     * Get enableLive
     *
     * @access public
     * @return boolean 
     */
    public function getEnableLive()
    {
        return $this->enableLive;
    }

    /**
     * Set enableTable
     *
     * @access public
     * @param boolean $enableTable
     * @return SportEvent
     */
    public function setEnableTable($enableTable)
    {
        $this->enableTable = $enableTable;
        return $this;
    }

    /**
     * Get enableTable
     *
     * @access public
     * @return boolean 
     */
    public function getEnableTable()
    {
        return $this->enableTable;
    }

    /**
     * Set enableResults
     *
     * @access public
     * @param boolean $enableResults
     * @return SportEvent
     */
    public function setEnableResults($enableResults)
    {
        $this->enableResults = $enableResults;
        return $this;
    }

    /**
     * Get enableResults
     *
     * @access public
     * @return boolean 
     */
    public function getEnableResults()
    {
        return $this->enableResults;
    }

    /**
     * Set enableTeams
     *
     * @access public
     * @param boolean $enableTeams
     * @return SportEvent
     */
    public function setEnableTeams($enableTeams)
    {
        $this->enableTeams = $enableTeams;
        return $this;
    }

    /**
     * Get enableTeams
     *
     * @access public
     * @return boolean 
     */
    public function getEnableTeams()
    {
        return $this->enableTeams;
    }

    /**
     * Set enableScorers
     *
     * @access public
     * @param boolean $enableScorers
     * @return SportEvent
     */
    public function setEnableScorers($enableScorers)
    {
        $this->enableScorers = $enableScorers;
        return $this;
    }

    /**
     * Get enableScorers
     *
     * @access public
     * @return boolean 
     */
    public function getEnableScorers()
    {
        return $this->enableScorers;
    }

    /**
     * Set enableStadia
     *
     * @access public
     * @param boolean $enableStadia
     * @return SportEvent
     */
    public function setEnableStadia($enableStadia)
    {
        $this->enableStadia = $enableStadia;
        return $this;
    }

    /**
     * Get enableStadia
     *
     * @access public
     * @return boolean 
     */
    public function getEnableStadia()
    {
        return $this->enableStadia;
    }

    /**
     * Set enablePrizeWinners
     *
     * @access public
     * @param boolean $enablePrizeWinners
     * @return SportEvent
     */
    public function setEnablePrizeWinners($enablePrizeWinners)
    {
        $this->enablePrizeWinners = $enablePrizeWinners;
        return $this;
    }

    /**
     * Get enablePrizeWinners
     *
     * @access public
     * @return boolean 
     */
    public function getEnablePrizeWinners()
    {
        return $this->enablePrizeWinners;
    }

    /**
     * Set enableStatistics
     *
     * @access public
     * @param boolean $enableStatistics
     * @return SportEvent
     */
    public function setEnableStatistics($enableStatistics)
    {
        $this->enableStatistics = $enableStatistics;
        return $this;
    }

    /**
     * Get enableStatistics
     *
     * @access public
     * @return boolean 
     */
    public function getEnableStatistics()
    {
        return $this->enableStatistics;
    }

    /**
     * Set enableLineUp
     *
     * @access public
     * @param boolean $enableLineUp
     * @return SportEvent
     */
    public function setEnableLineUp($enableLineUp)
    {
        $this->enableLineUp = $enableLineUp;
        return $this;
    }

    /**
     * Get enableLineUp
     *
     * @access public
     * @return boolean 
     */
    public function getEnableLineUp()
    {
        return $this->enableLineUp;
    }

    /**
     * Set enablePosts
     *
     * @access public
     * @param boolean $enablePosts
     * @return SportEvent
     */
    public function setEnablePosts($enablePosts)
    {
        $this->enablePosts = $enablePosts;
        return $this;
    }

    /**
     * Get enablePosts
     *
     * @access public
     * @return boolean 
     */
    public function getEnablePosts()
    {
        return $this->enablePosts;
    }

    /**
     * Set enableVideos
     *
     * @access public
     * @param boolean $enableVideos
     * @return SportEvent
     */
    public function setEnableVideos($enableVideos)
    {
        $this->enableVideos = $enableVideos;
        return $this;
    }

    /**
     * Get enableVideos
     *
     * @access public
     * @return boolean 
     */
    public function getEnableVideos()
    {
        return $this->enableVideos;
    }

    /**
     * Set enableImages
     *
     * @access public
     * @param boolean $enableImages
     * @return SportEvent
     */
    public function setEnableImages($enableImages)
    {
        $this->enableImages = $enableImages;
        return $this;
    }

    /**
     * Get enableImages
     *
     * @access public
     * @return boolean 
     */
    public function getEnableImages()
    {
        return $this->enableImages;
    }

    /**
     * Set status
     *
     * @access public
     * @param string $status
     * @return SportEvent
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
     * @return SportEvent
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
     * @return SportEvent
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
     * @return SportEvent
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
     * @return SportEvent
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
     * Set sport
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Sport $sport
     * @return SportEvent
     */
    public function setSport(Sport $sport = null)
    {
        $this->sport = $sport;
        return $this;
    }

    /**
     * Get sport
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Sport 
     */
    public function getSport()
    {
        return $this->sport;
    }

    /**
     * Set season
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Season $season
     * @return SportEvent
     */
    public function setSeason(Season $season = null)
    {
        $this->season = $season;
        return $this;
    }

    /**
     * Get season
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Season 
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * Set postType
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\PostType $postType
     * @return SportEvent
     */
    public function setPostType(PostType $postType = null)
    {
        $this->postType = $postType;
        return $this;
    }

    /**
     * Get postType
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\PostType 
     */
    public function getPostType()
    {
        return $this->postType;
    }

    /**
     * Set postCategory
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\PostCategory $postCategory
     * @return SportEvent
     */
    public function setPostCategory(PostCategory $postCategory = null)
    {
        $this->postCategory = $postCategory;
        return $this;
    }

    /**
     * Get postCategory
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\PostCategory 
     */
    public function getPostCategory()
    {
        return $this->postCategory;
    }

    /**
     * Set country
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Country $country
     * @return SportEvent
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
     * Set creatorUser
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\User $creatorUser
     * @return SportEvent
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
     * @return SportEvent
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
     * Add team
     *
     * @access public
     * @param Team $team
     * @return SportEvent
     */
    public function addTeam(Team $team)
    {
        if (!$this->teams->contains($team))
        {
            $this->teams->add($team);
        }
        return $this;
    }

    /**
     * Remove team
     *
     * @access public
     * @param Team $team
     * @return SportEvent
     */
    public function removeTeam(Team $team)
    {
        if ($this->teams->contains($team))
        {
            $this->teams->removeElement($team);
        }
        return $this;
    }

    /**
     * Set team
     *
     * @access public
     * @param \Doctrine\Common\Collections\Collection
     * @return SportEvent
     */
    public function setTeams($teams)
    {
        $this->teams = $teams;
        return $this;
    }

    /**
     * Get team
     *
     * @access public
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTeams()
    {
        return $this->teams;
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
