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
 * @license	CONTINUOUS NET REGULAR LICENSE
 * @version    Release: 1.0
 * @link       http://publipr.continuousnet.com/ContinuousNet/PubliPrBundle/Entity
 * @see        Newsroom
 * @since      Class available since Release 1.0
 * @deprecated Nothing
 * @access     public
 * 
 * @ORM\Table(name="`newsroom`", indexes={@ORM\Index(name="title_font_id", columns={"title_font_id"}), @ORM\Index(name="text_font_id", columns={"text_font_id"}), @ORM\Index(name="creator_user_id", columns={"creator_user_id"}), @ORM\Index(name="modifier_user_id", columns={"modifier_user_id"})})
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
     * @ORM\Column(name="background_color", type="string", length=7, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $backgroundColor;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="title_color", type="string", length=7, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $titleColor;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="text_color", type="string", length=7, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $textColor;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="facebook_link", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $facebookLink;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="twitter_link", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $twitterLink;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="google_plus_link", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $googlePlusLink;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="pinterest_link", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $pinterestLink;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="instagram_link", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $instagramLink;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="youtube_link", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $youtubeLink;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="linkedin_link", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $linkedinLink;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="viadeo_link", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $viadeoLink;

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
     * @var \ContinuousNet\PubliPrBundle\Entity\Font
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Font")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="title_font_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $titleFont;

    /**
     * @var \ContinuousNet\PubliPrBundle\Entity\Font
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Font")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="text_font_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $textFont;

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
     * @ORM\ManyToMany(targetEntity="User", inversedBy="newsrooms")
     * @ORM\JoinTable(name="newsrooms_users",
     *     joinColumns={
     *         @ORM\JoinColumn(name="newsroom_id", referencedColumnName="id")
     *     },
     *     inverseJoinColumns={
     *         @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *     }
     * )
     * 
     * @Expose
     * @MaxDepth(2)
     * 
     */
    private $users;

    /**
     * Constructor
     * 
     * @access public
     */
    public function __construct()
    {
        $this->users = new DoctrineCollection();
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
     * Set backgroundColor
     *
     * @access public
     * @param string $backgroundColor
     * @return Newsroom
     */
    public function setBackgroundColor($backgroundColor = null)
    {
        $this->backgroundColor = $backgroundColor;
        return $this;
    }

    /**
     * Get backgroundColor
     *
     * @access public
     * @return string 
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * Set titleColor
     *
     * @access public
     * @param string $titleColor
     * @return Newsroom
     */
    public function setTitleColor($titleColor = null)
    {
        $this->titleColor = $titleColor;
        return $this;
    }

    /**
     * Get titleColor
     *
     * @access public
     * @return string 
     */
    public function getTitleColor()
    {
        return $this->titleColor;
    }

    /**
     * Set textColor
     *
     * @access public
     * @param string $textColor
     * @return Newsroom
     */
    public function setTextColor($textColor = null)
    {
        $this->textColor = $textColor;
        return $this;
    }

    /**
     * Get textColor
     *
     * @access public
     * @return string 
     */
    public function getTextColor()
    {
        return $this->textColor;
    }

    /**
     * Set facebookLink
     *
     * @access public
     * @param string $facebookLink
     * @return Newsroom
     */
    public function setFacebookLink($facebookLink = null)
    {
        $this->facebookLink = $facebookLink;
        return $this;
    }

    /**
     * Get facebookLink
     *
     * @access public
     * @return string 
     */
    public function getFacebookLink()
    {
        return $this->facebookLink;
    }

    /**
     * Set twitterLink
     *
     * @access public
     * @param string $twitterLink
     * @return Newsroom
     */
    public function setTwitterLink($twitterLink = null)
    {
        $this->twitterLink = $twitterLink;
        return $this;
    }

    /**
     * Get twitterLink
     *
     * @access public
     * @return string 
     */
    public function getTwitterLink()
    {
        return $this->twitterLink;
    }

    /**
     * Set googlePlusLink
     *
     * @access public
     * @param string $googlePlusLink
     * @return Newsroom
     */
    public function setGooglePlusLink($googlePlusLink = null)
    {
        $this->googlePlusLink = $googlePlusLink;
        return $this;
    }

    /**
     * Get googlePlusLink
     *
     * @access public
     * @return string 
     */
    public function getGooglePlusLink()
    {
        return $this->googlePlusLink;
    }

    /**
     * Set pinterestLink
     *
     * @access public
     * @param string $pinterestLink
     * @return Newsroom
     */
    public function setPinterestLink($pinterestLink = null)
    {
        $this->pinterestLink = $pinterestLink;
        return $this;
    }

    /**
     * Get pinterestLink
     *
     * @access public
     * @return string 
     */
    public function getPinterestLink()
    {
        return $this->pinterestLink;
    }

    /**
     * Set instagramLink
     *
     * @access public
     * @param string $instagramLink
     * @return Newsroom
     */
    public function setInstagramLink($instagramLink = null)
    {
        $this->instagramLink = $instagramLink;
        return $this;
    }

    /**
     * Get instagramLink
     *
     * @access public
     * @return string 
     */
    public function getInstagramLink()
    {
        return $this->instagramLink;
    }

    /**
     * Set youtubeLink
     *
     * @access public
     * @param string $youtubeLink
     * @return Newsroom
     */
    public function setYoutubeLink($youtubeLink = null)
    {
        $this->youtubeLink = $youtubeLink;
        return $this;
    }

    /**
     * Get youtubeLink
     *
     * @access public
     * @return string 
     */
    public function getYoutubeLink()
    {
        return $this->youtubeLink;
    }

    /**
     * Set linkedinLink
     *
     * @access public
     * @param string $linkedinLink
     * @return Newsroom
     */
    public function setLinkedinLink($linkedinLink = null)
    {
        $this->linkedinLink = $linkedinLink;
        return $this;
    }

    /**
     * Get linkedinLink
     *
     * @access public
     * @return string 
     */
    public function getLinkedinLink()
    {
        return $this->linkedinLink;
    }

    /**
     * Set viadeoLink
     *
     * @access public
     * @param string $viadeoLink
     * @return Newsroom
     */
    public function setViadeoLink($viadeoLink = null)
    {
        $this->viadeoLink = $viadeoLink;
        return $this;
    }

    /**
     * Get viadeoLink
     *
     * @access public
     * @return string 
     */
    public function getViadeoLink()
    {
        return $this->viadeoLink;
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
     * Set titleFont
     *
     * @access public
     * @param \ContinuousNet\PubliPrBundle\Entity\Font $titleFont
     * @return Newsroom
     */
    public function setTitleFont(Font $titleFont = null)
    {
        $this->titleFont = $titleFont;
        return $this;
    }

    /**
     * Get titleFont
     *
     * @access public
     * @return \ContinuousNet\PubliPrBundle\Entity\Font 
     */
    public function getTitleFont()
    {
        return $this->titleFont;
    }

    /**
     * Set textFont
     *
     * @access public
     * @param \ContinuousNet\PubliPrBundle\Entity\Font $textFont
     * @return Newsroom
     */
    public function setTextFont(Font $textFont = null)
    {
        $this->textFont = $textFont;
        return $this;
    }

    /**
     * Get textFont
     *
     * @access public
     * @return \ContinuousNet\PubliPrBundle\Entity\Font 
     */
    public function getTextFont()
    {
        return $this->textFont;
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
     * Add user
     *
     * @access public
     * @param User $user
     * @return Newsroom
     */
    public function addUser(User $user)
    {
        if (!$this->users->contains($user))
        {
            $this->users->add($user);
        }
        return $this;
    }

    /**
     * Remove user
     *
     * @access public
     * @param User $user
     * @return Newsroom
     */
    public function removeUser(User $user)
    {
        if ($this->users->contains($user))
        {
            $this->users->removeElement($user);
        }
        return $this;
    }

    /**
     * Set user
     *
     * @access public
     * @param \Doctrine\Common\Collections\Collection
     * @return Newsroom
     */
    public function setUsers($users)
    {
        $this->users = $users;
        return $this;
    }

    /**
     * Get user
     *
     * @access public
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
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
