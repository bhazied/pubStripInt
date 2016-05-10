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
 * Post Category Entity
 * 
 * Storing PostCategories data to the database using Doctrine
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
 * @see        PostCategory
 * @since      Class available since Release 1.0
 * @access     public
 * 
 * @ORM\Table(name="`post_category`", indexes={@ORM\Index(name="parent_id", columns={"parent_id"}), @ORM\Index(name="post_type_id", columns={"post_type_id"}), @ORM\Index(name="creator_user_id", columns={"creator_user_id"}), @ORM\Index(name="modifier_user_id", columns={"modifier_user_id"})})
 * @ORM\Entity
 * @UniqueEntity("name")
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class PostCategory 
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
     * @ORM\Column(name="description", type="string", length=320, nullable=false, unique=false)
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
     * @ORM\Column(name="ordering", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $ordering;

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
     * @var \ContinuousNet\SportClubBundle\Entity\PostCategory
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="PostCategory")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $parent;

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
     * @ORM\ManyToMany(targetEntity="Post", inversedBy="postCategories")
     * @ORM\JoinTable(name="posts_post_categories",
     *     joinColumns={
     *         @ORM\JoinColumn(name="post_category_id", referencedColumnName="id")
     *     },
     *     inverseJoinColumns={
     *         @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     *     }
     * )
     * 
     * @Expose
     * @MaxDepth(2)
     * 
     */
    private $posts;

    /**
     * Constructor
     * 
     * @access public
     */
    public function __construct()
    {
        $this->posts = new DoctrineCollection();
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
     * @return PostCategory
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
     * @return PostCategory
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
     * @return PostCategory
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
     * @return PostCategory
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
     * @return PostCategory
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
     * @return PostCategory
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
     * @return PostCategory
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
     * Set description
     *
     * @access public
     * @param string $description
     * @return PostCategory
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
     * Set descriptionAr
     *
     * @access public
     * @param string $descriptionAr
     * @return PostCategory
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
     * @return PostCategory
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
     * Set ordering
     *
     * @access public
     * @param integer $ordering
     * @return PostCategory
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
     * Set status
     *
     * @access public
     * @param string $status
     * @return PostCategory
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
     * Set createdAt
     *
     * @access public
     * @param \DateTime $createdAt
     * @return PostCategory
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
     * @return PostCategory
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
     * Set parent
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\PostCategory $parent
     * @return PostCategory
     */
    public function setParent(PostCategory $parent = null)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Get parent
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\PostCategory 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set postType
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\PostType $postType
     * @return PostCategory
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
     * @return PostCategory
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
     * @return PostCategory
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
     * Add post
     *
     * @access public
     * @param Post $post
     * @return PostCategory
     */
    public function addPost(Post $post)
    {
        if (!$this->posts->contains($post))
        {
            $this->posts->add($post);
        }
        return $this;
    }

    /**
     * Remove post
     *
     * @access public
     * @param Post $post
     * @return PostCategory
     */
    public function removePost(Post $post)
    {
        if ($this->posts->contains($post))
        {
            $this->posts->removeElement($post);
        }
        return $this;
    }

    /**
     * Set post
     *
     * @access public
     * @param \Doctrine\Common\Collections\Collection
     * @return PostCategory
     */
    public function setPosts($posts)
    {
        $this->posts = $posts;
        return $this;
    }

    /**
     * Get post
     *
     * @access public
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPosts()
    {
        return $this->posts;
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
