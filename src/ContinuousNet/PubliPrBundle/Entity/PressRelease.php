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
 * Press Release Entity
 * 
 * Storing PressReleases data to the database using Doctrine
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
 * @see        PressRelease
 * @since      Class available since Release 1.0
 * @access     public
 * 
 * @ORM\Table(name="`press_release`", indexes={@ORM\Index(name="newsroom_id", columns={"newsroom_id"}), @ORM\Index(name="creator_user_id", columns={"creator_user_id"}), @ORM\Index(name="modifier_user_id", columns={"modifier_user_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class PressRelease 
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
     * @ORM\Column(name="title", type="string", length=320, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $title;

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
     * @ORM\Column(name="picture_preview", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $picturePreview;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="content", type="text", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $content;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="is_headline", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $isHeadline;

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
     * @ORM\Column(name="publish_date_time", type="datetime", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $publishDateTime;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="meta_title", type="text", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $metaTitle;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="meta_description", type="text", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $metaDescription;

    /**
     * @var array
     * @access private
     *
     * @ORM\Column(name="meta_keywords", type="array", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $metaKeywords;

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
     * @ORM\Column(name="total_prints", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $totalPrints;

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
     * @var integer
     * @access private
     *
     * @ORM\Column(name="total_shares", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $totalShares;

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
     * @var \ContinuousNet\PubliPrBundle\Entity\Newsroom
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Newsroom")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="newsroom_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $newsroom;

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
     * Set title
     *
     * @access public
     * @param string $title
     * @return PressRelease
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get title
     *
     * @access public
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @access public
     * @param string $slug
     * @return PressRelease
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
     * Set description
     *
     * @access public
     * @param string $description
     * @return PressRelease
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
     * Set picturePreview
     *
     * @access public
     * @param string $picturePreview
     * @return PressRelease
     */
    public function setPicturePreview($picturePreview = null)
    {
        $this->picturePreview = $picturePreview;
        return $this;
    }

    /**
     * Get picturePreview
     *
     * @access public
     * @return string 
     */
    public function getPicturePreview()
    {
        return $this->picturePreview;
    }

    /**
     * Set content
     *
     * @access public
     * @param string $content
     * @return PressRelease
     */
    public function setContent($content = null)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Get content
     *
     * @access public
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set isHeadline
     *
     * @access public
     * @param boolean $isHeadline
     * @return PressRelease
     */
    public function setIsHeadline($isHeadline)
    {
        $this->isHeadline = $isHeadline;
        return $this;
    }

    /**
     * Get isHeadline
     *
     * @access public
     * @return boolean 
     */
    public function getIsHeadline()
    {
        return $this->isHeadline;
    }

    /**
     * Set autoPublishing
     *
     * @access public
     * @param boolean $autoPublishing
     * @return PressRelease
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
     * @return PressRelease
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
     * @return PressRelease
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
     * Set publishDateTime
     *
     * @access public
     * @param \DateTime $publishDateTime
     * @return PressRelease
     */
    public function setPublishDateTime(\DateTime $publishDateTime)
    {
        $this->publishDateTime = $publishDateTime;
        return $this;
    }

    /**
     * Get publishDateTime
     *
     * @access public
     * @return \DateTime 
     */
    public function getPublishDateTime()
    {
        return $this->publishDateTime;
    }

    /**
     * Set metaTitle
     *
     * @access public
     * @param string $metaTitle
     * @return PressRelease
     */
    public function setMetaTitle($metaTitle = null)
    {
        $this->metaTitle = $metaTitle;
        return $this;
    }

    /**
     * Get metaTitle
     *
     * @access public
     * @return string 
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * Set metaDescription
     *
     * @access public
     * @param string $metaDescription
     * @return PressRelease
     */
    public function setMetaDescription($metaDescription = null)
    {
        $this->metaDescription = $metaDescription;
        return $this;
    }

    /**
     * Get metaDescription
     *
     * @access public
     * @return string 
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * Set metaKeywords
     *
     * @access public
     * @param array $metaKeywords
     * @return PressRelease
     */
    public function setMetaKeywords(array $metaKeywords = null)
    {
        $this->metaKeywords = $metaKeywords;
        return $this;
    }

    /**
     * Get metaKeywords
     *
     * @access public
     * @return array 
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * Set status
     *
     * @access public
     * @param string $status
     * @return PressRelease
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
     * Set totalPrints
     *
     * @access public
     * @param integer $totalPrints
     * @return PressRelease
     */
    public function setTotalPrints($totalPrints = null)
    {
        $this->totalPrints = $totalPrints;
        return $this;
    }

    /**
     * Get totalPrints
     *
     * @access public
     * @return integer 
     */
    public function getTotalPrints()
    {
        return $this->totalPrints;
    }

    /**
     * Set totalHits
     *
     * @access public
     * @param integer $totalHits
     * @return PressRelease
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
     * @return PressRelease
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
     * @return PressRelease
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
     * @return PressRelease
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
     * @return PressRelease
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
     * @return PressRelease
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
     * @return PressRelease
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
     * Set totalShares
     *
     * @access public
     * @param integer $totalShares
     * @return PressRelease
     */
    public function setTotalShares($totalShares = null)
    {
        $this->totalShares = $totalShares;
        return $this;
    }

    /**
     * Get totalShares
     *
     * @access public
     * @return integer 
     */
    public function getTotalShares()
    {
        return $this->totalShares;
    }

    /**
     * Set createdAt
     *
     * @access public
     * @param \DateTime $createdAt
     * @return PressRelease
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
     * @return PressRelease
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
     * Set newsroom
     *
     * @access public
     * @param \ContinuousNet\PubliPrBundle\Entity\Newsroom $newsroom
     * @return PressRelease
     */
    public function setNewsroom(Newsroom $newsroom = null)
    {
        $this->newsroom = $newsroom;
        return $this;
    }

    /**
     * Get newsroom
     *
     * @access public
     * @return \ContinuousNet\PubliPrBundle\Entity\Newsroom 
     */
    public function getNewsroom()
    {
        return $this->newsroom;
    }

    /**
     * Set creatorUser
     *
     * @access public
     * @param \ContinuousNet\PubliPrBundle\Entity\User $creatorUser
     * @return PressRelease
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
     * @return PressRelease
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
