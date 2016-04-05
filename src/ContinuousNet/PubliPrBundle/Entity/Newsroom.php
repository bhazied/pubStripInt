<?php

namespace ContinuousNet\PubliPrBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Events;
use Doctrine\Common\Collections\ArrayCollection as DoctrineCollection;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Annotation\Groups;

/**
 * Newsroom Entity
 * 
 * Storing Newsrooms data to the database using Doctrine
 * 
 * PHP version 5.4.4
 * 
 * @category   Doctrine 2 Entity
 * @package    ContinuousNet\PubliPrBundle\Entity
 * @author     Sahbi KHALFALLAH <sahbi.khalfallah@continuousnet.com>
 * @copyright  2016 CONTINUOUS NET
 * @license    http://www.zend.com/license/3_0.txt PHP License 3.0
 * @version    Release: 1.0
 * @link       http://publipr.continuousnet.com/ContinuousNet/PubliPrBundle/Entity
 * @see        Newsroom
 * @since      Class available since Release 1.0
 * @deprecated Nothing
 * @access     public
 * 
 * @ORM\Table(name="`newsroom`", indexes={@ORM\Index(name="creator_user_id", columns={"creator_user_id"}), @ORM\Index(name="modifier_user_id", columns={"modifier_user_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class Newsroom 
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $name;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=false, unique=false)
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
     * @ORM\Column(name="url", type="string", length=512, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $url;

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
     * @ORM\Column(name="logo_picture", type="string", length=255, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $logoPicture;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="banner_picture", type="string", length=255, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $bannerPicture;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="press_releases_per_page", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $pressReleasesPerPage;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="css", type="text", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $css;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="enable_search", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $enableSearch;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="enable_social_networks", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $enableSocialNetworks;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="enable_media", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $enableMedia;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="enable_date", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $enableDate;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="published", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $published;

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
     * @return Newsroom
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
     * Set slug
     *
     * @access public
     * @param string $slug
     * @return Newsroom
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
     * @return Newsroom
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
     * Set url
     *
     * @access public
     * @param string $url
     * @return Newsroom
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
     * Set email
     *
     * @access public
     * @param string $email
     * @return Newsroom
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
     * Set logoPicture
     *
     * @access public
     * @param string $logoPicture
     * @return Newsroom
     */
    public function setLogoPicture($logoPicture)
    {
        $this->logoPicture = $logoPicture;
        return $this;
    }

    /**
     * Get logoPicture
     *
     * @access public
     * @return string 
     */
    public function getLogoPicture()
    {
        return $this->logoPicture;
    }

    /**
     * Set bannerPicture
     *
     * @access public
     * @param string $bannerPicture
     * @return Newsroom
     */
    public function setBannerPicture($bannerPicture)
    {
        $this->bannerPicture = $bannerPicture;
        return $this;
    }

    /**
     * Get bannerPicture
     *
     * @access public
     * @return string 
     */
    public function getBannerPicture()
    {
        return $this->bannerPicture;
    }

    /**
     * Set pressReleasesPerPage
     *
     * @access public
     * @param integer $pressReleasesPerPage
     * @return Newsroom
     */
    public function setPressReleasesPerPage($pressReleasesPerPage = null)
    {
        $this->pressReleasesPerPage = $pressReleasesPerPage;
        return $this;
    }

    /**
     * Get pressReleasesPerPage
     *
     * @access public
     * @return integer 
     */
    public function getPressReleasesPerPage()
    {
        return $this->pressReleasesPerPage;
    }

    /**
     * Set css
     *
     * @access public
     * @param string $css
     * @return Newsroom
     */
    public function setCss($css = null)
    {
        $this->css = $css;
        return $this;
    }

    /**
     * Get css
     *
     * @access public
     * @return string 
     */
    public function getCss()
    {
        return $this->css;
    }

    /**
     * Set enableSearch
     *
     * @access public
     * @param boolean $enableSearch
     * @return Newsroom
     */
    public function setEnableSearch($enableSearch)
    {
        $this->enableSearch = $enableSearch;
        return $this;
    }

    /**
     * Get enableSearch
     *
     * @access public
     * @return boolean 
     */
    public function getEnableSearch()
    {
        return $this->enableSearch;
    }

    /**
     * Set enableSocialNetworks
     *
     * @access public
     * @param boolean $enableSocialNetworks
     * @return Newsroom
     */
    public function setEnableSocialNetworks($enableSocialNetworks)
    {
        $this->enableSocialNetworks = $enableSocialNetworks;
        return $this;
    }

    /**
     * Get enableSocialNetworks
     *
     * @access public
     * @return boolean 
     */
    public function getEnableSocialNetworks()
    {
        return $this->enableSocialNetworks;
    }

    /**
     * Set enableMedia
     *
     * @access public
     * @param boolean $enableMedia
     * @return Newsroom
     */
    public function setEnableMedia($enableMedia)
    {
        $this->enableMedia = $enableMedia;
        return $this;
    }

    /**
     * Get enableMedia
     *
     * @access public
     * @return boolean 
     */
    public function getEnableMedia()
    {
        return $this->enableMedia;
    }

    /**
     * Set enableDate
     *
     * @access public
     * @param boolean $enableDate
     * @return Newsroom
     */
    public function setEnableDate($enableDate)
    {
        $this->enableDate = $enableDate;
        return $this;
    }

    /**
     * Get enableDate
     *
     * @access public
     * @return boolean 
     */
    public function getEnableDate()
    {
        return $this->enableDate;
    }

    /**
     * Set published
     *
     * @access public
     * @param boolean $published
     * @return Newsroom
     */
    public function setPublished($published)
    {
        $this->published = $published;
        return $this;
    }

    /**
     * Get published
     *
     * @access public
     * @return boolean 
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set createdAt
     *
     * @access public
     * @param \DateTime $createdAt
     * @return Newsroom
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
     * @return Newsroom
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
     * @return Newsroom
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
     * @return Newsroom
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
