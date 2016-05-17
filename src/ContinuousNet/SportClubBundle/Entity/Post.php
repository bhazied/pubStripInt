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
 * Post Entity
 * 
 * Storing Posts data to the database using Doctrine
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
 * @see        Post
 * @since      Class available since Release 1.0
 * @access     public
 * 
 * @ORM\Table(name="`post`", indexes={@ORM\Index(name="post_type_id", columns={"post_type_id"}), @ORM\Index(name="creator_user_id", columns={"creator_user_id"}), @ORM\Index(name="modifier_user_id", columns={"modifier_user_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class Post 
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
     * @ORM\Column(name="title_ar", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $titleAr;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="title_fr", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $titleFr;

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
     * @ORM\Column(name="content", type="text", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $content;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="content_ar", type="text", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $contentAr;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="content_fr", type="text", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $contentFr;

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
     * @ORM\Column(name="publish_date", type="date", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $publishDate;

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
     * @var integer
     * @access private
     *
     * @ORM\Column(name="ordering", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $ordering;

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
     * @ORM\ManyToMany(targetEntity="PostCategory", inversedBy="posts")
     * @ORM\JoinTable(name="posts_post_categories",
     *     joinColumns={
     *         @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     *     },
     *     inverseJoinColumns={
     *         @ORM\JoinColumn(name="post_category_id", referencedColumnName="id")
     *     }
     * )
     * 
     * @Expose
     * @MaxDepth(2)
     * 
     */
    private $postCategories;

    /**
     * Constructor
     * 
     * @access public
     */
    public function __construct()
    {
        $this->postCategories = new DoctrineCollection();
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
     * @return Post
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
     * Set titleAr
     *
     * @access public
     * @param string $titleAr
     * @return Post
     */
    public function setTitleAr($titleAr = null)
    {
        $this->titleAr = $titleAr;
        return $this;
    }

    /**
     * Get titleAr
     *
     * @access public
     * @return string 
     */
    public function getTitleAr()
    {
        return $this->titleAr;
    }

    /**
     * Set titleFr
     *
     * @access public
     * @param string $titleFr
     * @return Post
     */
    public function setTitleFr($titleFr = null)
    {
        $this->titleFr = $titleFr;
        return $this;
    }

    /**
     * Get titleFr
     *
     * @access public
     * @return string 
     */
    public function getTitleFr()
    {
        return $this->titleFr;
    }

    /**
     * Set slug
     *
     * @access public
     * @param string $slug
     * @return Post
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
     * @return Post
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
     * @return Post
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
     * @return Post
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
     * Set content
     *
     * @access public
     * @param string $content
     * @return Post
     */
    public function setContent($content)
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
     * Set contentAr
     *
     * @access public
     * @param string $contentAr
     * @return Post
     */
    public function setContentAr($contentAr = null)
    {
        $this->contentAr = $contentAr;
        return $this;
    }

    /**
     * Get contentAr
     *
     * @access public
     * @return string 
     */
    public function getContentAr()
    {
        return $this->contentAr;
    }

    /**
     * Set contentFr
     *
     * @access public
     * @param string $contentFr
     * @return Post
     */
    public function setContentFr($contentFr = null)
    {
        $this->contentFr = $contentFr;
        return $this;
    }

    /**
     * Get contentFr
     *
     * @access public
     * @return string 
     */
    public function getContentFr()
    {
        return $this->contentFr;
    }

    /**
     * Set isHeadline
     *
     * @access public
     * @param boolean $isHeadline
     * @return Post
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
     * @return Post
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
     * @return Post
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
     * @return Post
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
     * Set publishDate
     *
     * @access public
     * @param \DateTime $publishDate
     * @return Post
     */
    public function setPublishDate(\DateTime $publishDate)
    {
        $this->publishDate = $publishDate;
        return $this;
    }

    /**
     * Get publishDate
     *
     * @access public
     * @return \DateTime 
     */
    public function getPublishDate()
    {
        return $this->publishDate;
    }

    /**
     * Set metaTitle
     *
     * @access public
     * @param string $metaTitle
     * @return Post
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
     * @return Post
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
     * @return Post
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
     * @return Post
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
     * @return Post
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
     * @return Post
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
     * @return Post
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
     * @return Post
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
     * @return Post
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
     * @return Post
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
     * @return Post
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
     * @return Post
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
     * Set isTop
     *
     * @access public
     * @param boolean $isTop
     * @return Post
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
     * @return Post
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
     * Set ordering
     *
     * @access public
     * @param integer $ordering
     * @return Post
     */
    public function setOrdering($ordering = null)
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
     * Set createdAt
     *
     * @access public
     * @param \DateTime $createdAt
     * @return Post
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
     * @return Post
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
     * Set postType
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\PostType $postType
     * @return Post
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
     * Set creatorUser
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\User $creatorUser
     * @return Post
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
     * @return Post
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
     * Add postCategory
     *
     * @access public
     * @param PostCategory $postCategory
     * @return Post
     */
    public function addPostCategory(PostCategory $postCategory)
    {
        if (!$this->postCategories->contains($postCategory))
        {
            $this->postCategories->add($postCategory);
        }
        return $this;
    }

    /**
     * Remove postCategory
     *
     * @access public
     * @param PostCategory $postCategory
     * @return Post
     */
    public function removePostCategory(PostCategory $postCategory)
    {
        if ($this->postCategories->contains($postCategory))
        {
            $this->postCategories->removeElement($postCategory);
        }
        return $this;
    }

    /**
     * Set postCategory
     *
     * @access public
     * @param \Doctrine\Common\Collections\Collection
     * @return Post
     */
    public function setPostCategories($postCategories)
    {
        $this->postCategories = $postCategories;
        return $this;
    }

    /**
     * Get postCategory
     *
     * @access public
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPostCategories()
    {
        return $this->postCategories;
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
