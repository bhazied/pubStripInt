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
 * Video Entity
 * 
 * Storing Videos data to the database using Doctrine
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
 * @see        Video
 * @since      Class available since Release 1.0
 * @access     public
 * 
 * @ORM\Table(name="`video`", indexes={@ORM\Index(name="video_type_id", columns={"video_type_id"}), @ORM\Index(name="price_id", columns={"price_id"}), @ORM\Index(name="sharing_id", columns={"sharing_id"}), @ORM\Index(name="show_id", columns={"show_id"}), @ORM\Index(name="creator_user_id", columns={"creator_user_id"}), @ORM\Index(name="modifier_user_id", columns={"modifier_user_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class Video 
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
     * @ORM\Column(name="slug", type="string", length=320, nullable=false, unique=false)
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
     * @ORM\Column(name="file", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $file;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="watermark_text", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $watermarkText;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="description", type="text", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $description;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="description_ar", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $descriptionAr;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="description_fr", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $descriptionFr;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="season_number", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $seasonNumber;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="episode_number", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $episodeNumber;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="duration", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $duration;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="remote_source", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $remoteSource;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="url", type="text", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $url;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="alternative_url", type="text", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $alternativeUrl;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="copyright", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $copyright;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="is_top", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $isTop;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="is_new", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $isNew;

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
     * @var integer
     * @access private
     *
     * @ORM\Column(name="total_previewed", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $totalPreviewed;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="total_downloads", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $totalDownloads;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="total_hits", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $totalHits;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="total_comments", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $totalComments;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="total_ratings", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $totalRatings;

    /**
     * @var float
     * @access private
     *
     * @ORM\Column(name="average_ratings", type="float", precision=10, scale=0, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $averageRatings;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="total_likes", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $totalLikes;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="total_dislikes", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $totalDislikes;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="total_bookmarks", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $totalBookmarks;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="enable_streaming", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $enableStreaming;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="auto_publishing", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $autoPublishing;

    /**
     * @var \DateTime
     * @access private
     *
     * @ORM\Column(name="start_publishing", type="datetime", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $startPublishing;

    /**
     * @var \DateTime
     * @access private
     *
     * @ORM\Column(name="end_publishing", type="datetime", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $endPublishing;

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
     * @var \ContinuousNet\SportClubBundle\Entity\VideoType
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="VideoType")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="video_type_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $videoType;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\Price
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Price")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="price_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $price;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\Sharing
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Sharing")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="sharing_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $sharing;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\Show
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Show")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="show_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $show;

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
     * @ORM\ManyToMany(targetEntity="VideoCategory", inversedBy="videos")
     * @ORM\JoinTable(name="videos_video_categories",
     *     joinColumns={
     *         @ORM\JoinColumn(name="video_id", referencedColumnName="id")
     *     },
     *     inverseJoinColumns={
     *         @ORM\JoinColumn(name="video_category_id", referencedColumnName="id")
     *     }
     * )
     * 
     * @Expose
     * @MaxDepth(2)
     * 
     */
    private $videoCategories;

    /**
     * Constructor
     * 
     * @access public
     */
    public function __construct()
    {
        $this->videoCategories = new DoctrineCollection();
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
     * @return Video
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
     * @return Video
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
     * @return Video
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
     * @return Video
     */
    public function setSlug($slug)
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
     * @return Video
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
     * @return Video
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
     * @return Video
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
     * Set file
     *
     * @access public
     * @param string $file
     * @return Video
     */
    public function setFile($file = null)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * Get file
     *
     * @access public
     * @return string 
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set watermarkText
     *
     * @access public
     * @param string $watermarkText
     * @return Video
     */
    public function setWatermarkText($watermarkText = null)
    {
        $this->watermarkText = $watermarkText;
        return $this;
    }

    /**
     * Get watermarkText
     *
     * @access public
     * @return string 
     */
    public function getWatermarkText()
    {
        return $this->watermarkText;
    }

    /**
     * Set description
     *
     * @access public
     * @param string $description
     * @return Video
     */
    public function setDescription($description = null)
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
     * Set descriptionAr
     *
     * @access public
     * @param string $descriptionAr
     * @return Video
     */
    public function setDescriptionAr($descriptionAr = null)
    {
        $this->descriptionAr = $descriptionAr;
        return $this;
    }

    /**
     * Get descriptionAr
     *
     * @access public
     * @return string 
     */
    public function getDescriptionAr()
    {
        return $this->descriptionAr;
    }

    /**
     * Set descriptionFr
     *
     * @access public
     * @param string $descriptionFr
     * @return Video
     */
    public function setDescriptionFr($descriptionFr = null)
    {
        $this->descriptionFr = $descriptionFr;
        return $this;
    }

    /**
     * Get descriptionFr
     *
     * @access public
     * @return string 
     */
    public function getDescriptionFr()
    {
        return $this->descriptionFr;
    }

    /**
     * Set seasonNumber
     *
     * @access public
     * @param integer $seasonNumber
     * @return Video
     */
    public function setSeasonNumber($seasonNumber = null)
    {
        $this->seasonNumber = $seasonNumber;
        return $this;
    }

    /**
     * Get seasonNumber
     *
     * @access public
     * @return integer 
     */
    public function getSeasonNumber()
    {
        return $this->seasonNumber;
    }

    /**
     * Set episodeNumber
     *
     * @access public
     * @param integer $episodeNumber
     * @return Video
     */
    public function setEpisodeNumber($episodeNumber = null)
    {
        $this->episodeNumber = $episodeNumber;
        return $this;
    }

    /**
     * Get episodeNumber
     *
     * @access public
     * @return integer 
     */
    public function getEpisodeNumber()
    {
        return $this->episodeNumber;
    }

    /**
     * Set duration
     *
     * @access public
     * @param integer $duration
     * @return Video
     */
    public function setDuration($duration = null)
    {
        $this->duration = $duration;
        return $this;
    }

    /**
     * Get duration
     *
     * @access public
     * @return integer 
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set remoteSource
     *
     * @access public
     * @param boolean $remoteSource
     * @return Video
     */
    public function setRemoteSource($remoteSource)
    {
        $this->remoteSource = $remoteSource;
        return $this;
    }

    /**
     * Get remoteSource
     *
     * @access public
     * @return boolean 
     */
    public function getRemoteSource()
    {
        return $this->remoteSource;
    }

    /**
     * Set url
     *
     * @access public
     * @param string $url
     * @return Video
     */
    public function setUrl($url = null)
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
     * Set alternativeUrl
     *
     * @access public
     * @param string $alternativeUrl
     * @return Video
     */
    public function setAlternativeUrl($alternativeUrl = null)
    {
        $this->alternativeUrl = $alternativeUrl;
        return $this;
    }

    /**
     * Get alternativeUrl
     *
     * @access public
     * @return string 
     */
    public function getAlternativeUrl()
    {
        return $this->alternativeUrl;
    }

    /**
     * Set copyright
     *
     * @access public
     * @param string $copyright
     * @return Video
     */
    public function setCopyright($copyright = null)
    {
        $this->copyright = $copyright;
        return $this;
    }

    /**
     * Get copyright
     *
     * @access public
     * @return string 
     */
    public function getCopyright()
    {
        return $this->copyright;
    }

    /**
     * Set isTop
     *
     * @access public
     * @param boolean $isTop
     * @return Video
     */
    public function setIsTop($isTop)
    {
        $this->isTop = $isTop;
        return $this;
    }

    /**
     * Get isTop
     *
     * @access public
     * @return boolean 
     */
    public function getIsTop()
    {
        return $this->isTop;
    }

    /**
     * Set isNew
     *
     * @access public
     * @param boolean $isNew
     * @return Video
     */
    public function setIsNew($isNew)
    {
        $this->isNew = $isNew;
        return $this;
    }

    /**
     * Get isNew
     *
     * @access public
     * @return boolean 
     */
    public function getIsNew()
    {
        return $this->isNew;
    }

    /**
     * Set status
     *
     * @access public
     * @param string $status
     * @return Video
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
     * Set totalPreviewed
     *
     * @access public
     * @param integer $totalPreviewed
     * @return Video
     */
    public function setTotalPreviewed($totalPreviewed = null)
    {
        $this->totalPreviewed = $totalPreviewed;
        return $this;
    }

    /**
     * Get totalPreviewed
     *
     * @access public
     * @return integer 
     */
    public function getTotalPreviewed()
    {
        return $this->totalPreviewed;
    }

    /**
     * Set totalDownloads
     *
     * @access public
     * @param integer $totalDownloads
     * @return Video
     */
    public function setTotalDownloads($totalDownloads = null)
    {
        $this->totalDownloads = $totalDownloads;
        return $this;
    }

    /**
     * Get totalDownloads
     *
     * @access public
     * @return integer 
     */
    public function getTotalDownloads()
    {
        return $this->totalDownloads;
    }

    /**
     * Set totalHits
     *
     * @access public
     * @param integer $totalHits
     * @return Video
     */
    public function setTotalHits($totalHits = null)
    {
        $this->totalHits = $totalHits;
        return $this;
    }

    /**
     * Get totalHits
     *
     * @access public
     * @return integer 
     */
    public function getTotalHits()
    {
        return $this->totalHits;
    }

    /**
     * Set totalComments
     *
     * @access public
     * @param integer $totalComments
     * @return Video
     */
    public function setTotalComments($totalComments = null)
    {
        $this->totalComments = $totalComments;
        return $this;
    }

    /**
     * Get totalComments
     *
     * @access public
     * @return integer 
     */
    public function getTotalComments()
    {
        return $this->totalComments;
    }

    /**
     * Set totalRatings
     *
     * @access public
     * @param integer $totalRatings
     * @return Video
     */
    public function setTotalRatings($totalRatings = null)
    {
        $this->totalRatings = $totalRatings;
        return $this;
    }

    /**
     * Get totalRatings
     *
     * @access public
     * @return integer 
     */
    public function getTotalRatings()
    {
        return $this->totalRatings;
    }

    /**
     * Set averageRatings
     *
     * @access public
     * @param float $averageRatings
     * @return Video
     */
    public function setAverageRatings($averageRatings = null)
    {
        $this->averageRatings = $averageRatings;
        return $this;
    }

    /**
     * Get averageRatings
     *
     * @access public
     * @return float 
     */
    public function getAverageRatings()
    {
        return $this->averageRatings;
    }

    /**
     * Set totalLikes
     *
     * @access public
     * @param integer $totalLikes
     * @return Video
     */
    public function setTotalLikes($totalLikes = null)
    {
        $this->totalLikes = $totalLikes;
        return $this;
    }

    /**
     * Get totalLikes
     *
     * @access public
     * @return integer 
     */
    public function getTotalLikes()
    {
        return $this->totalLikes;
    }

    /**
     * Set totalDislikes
     *
     * @access public
     * @param integer $totalDislikes
     * @return Video
     */
    public function setTotalDislikes($totalDislikes = null)
    {
        $this->totalDislikes = $totalDislikes;
        return $this;
    }

    /**
     * Get totalDislikes
     *
     * @access public
     * @return integer 
     */
    public function getTotalDislikes()
    {
        return $this->totalDislikes;
    }

    /**
     * Set totalBookmarks
     *
     * @access public
     * @param integer $totalBookmarks
     * @return Video
     */
    public function setTotalBookmarks($totalBookmarks = null)
    {
        $this->totalBookmarks = $totalBookmarks;
        return $this;
    }

    /**
     * Get totalBookmarks
     *
     * @access public
     * @return integer 
     */
    public function getTotalBookmarks()
    {
        return $this->totalBookmarks;
    }

    /**
     * Set enableStreaming
     *
     * @access public
     * @param boolean $enableStreaming
     * @return Video
     */
    public function setEnableStreaming($enableStreaming)
    {
        $this->enableStreaming = $enableStreaming;
        return $this;
    }

    /**
     * Get enableStreaming
     *
     * @access public
     * @return boolean 
     */
    public function getEnableStreaming()
    {
        return $this->enableStreaming;
    }

    /**
     * Set autoPublishing
     *
     * @access public
     * @param boolean $autoPublishing
     * @return Video
     */
    public function setAutoPublishing($autoPublishing)
    {
        $this->autoPublishing = $autoPublishing;
        return $this;
    }

    /**
     * Get autoPublishing
     *
     * @access public
     * @return boolean 
     */
    public function getAutoPublishing()
    {
        return $this->autoPublishing;
    }

    /**
     * Set startPublishing
     *
     * @access public
     * @param \DateTime $startPublishing
     * @return Video
     */
    public function setStartPublishing(\DateTime $startPublishing = null)
    {
        $this->startPublishing = $startPublishing;
        return $this;
    }

    /**
     * Get startPublishing
     *
     * @access public
     * @return \DateTime 
     */
    public function getStartPublishing()
    {
        return $this->startPublishing;
    }

    /**
     * Set endPublishing
     *
     * @access public
     * @param \DateTime $endPublishing
     * @return Video
     */
    public function setEndPublishing(\DateTime $endPublishing = null)
    {
        $this->endPublishing = $endPublishing;
        return $this;
    }

    /**
     * Get endPublishing
     *
     * @access public
     * @return \DateTime 
     */
    public function getEndPublishing()
    {
        return $this->endPublishing;
    }

    /**
     * Set createdAt
     *
     * @access public
     * @param \DateTime $createdAt
     * @return Video
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
     * @return Video
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
     * Set videoType
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\VideoType $videoType
     * @return Video
     */
    public function setVideoType(VideoType $videoType = null)
    {
        $this->videoType = $videoType;
        return $this;
    }

    /**
     * Get videoType
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\VideoType 
     */
    public function getVideoType()
    {
        return $this->videoType;
    }

    /**
     * Set price
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Price $price
     * @return Video
     */
    public function setPrice(Price $price = null)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Get price
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Price 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set sharing
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Sharing $sharing
     * @return Video
     */
    public function setSharing(Sharing $sharing = null)
    {
        $this->sharing = $sharing;
        return $this;
    }

    /**
     * Get sharing
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Sharing 
     */
    public function getSharing()
    {
        return $this->sharing;
    }

    /**
     * Set show
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Show $show
     * @return Video
     */
    public function setShow(Show $show = null)
    {
        $this->show = $show;
        return $this;
    }

    /**
     * Get show
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Show 
     */
    public function getShow()
    {
        return $this->show;
    }

    /**
     * Set creatorUser
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\User $creatorUser
     * @return Video
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
     * @return Video
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
     * Add videoCategory
     *
     * @access public
     * @param VideoCategory $videoCategory
     * @return Video
     */
    public function addVideoCategory(VideoCategory $videoCategory)
    {
        if (!$this->videoCategories->contains($videoCategory))
        {
            $this->videoCategories->add($videoCategory);
        }
        return $this;
    }

    /**
     * Remove videoCategory
     *
     * @access public
     * @param VideoCategory $videoCategory
     * @return Video
     */
    public function removeVideoCategory(VideoCategory $videoCategory)
    {
        if ($this->videoCategories->contains($videoCategory))
        {
            $this->videoCategories->removeElement($videoCategory);
        }
        return $this;
    }

    /**
     * Set videoCategory
     *
     * @access public
     * @param \Doctrine\Common\Collections\Collection
     * @return Video
     */
    public function setVideoCategories($videoCategories)
    {
        $this->videoCategories = $videoCategories;
        return $this;
    }

    /**
     * Get videoCategory
     *
     * @access public
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVideoCategories()
    {
        return $this->videoCategories;
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
