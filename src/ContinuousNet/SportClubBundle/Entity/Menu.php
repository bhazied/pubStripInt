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
 * Menu Entity
 * 
 * Storing Menus data to the database using Doctrine
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
 * @see        Menu
 * @since      Class available since Release 1.0
 * @access     public
 * 
 * @ORM\Table(name="`menu`", indexes={@ORM\Index(name="creator_user_id", columns={"creator_user_id"}), @ORM\Index(name="modifier_user_id", columns={"modifier_user_id"})})
 * @ORM\Entity
 * @UniqueEntity("name")
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class Menu 
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
     * @ORM\Column(name="name", type="string", length=100, nullable=false, unique=true)
     * 
     * @Expose
     * 
     */
    private $name;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="name_ar", type="string", length=100, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $nameAr;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="name_fr", type="string", length=100, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $nameFr;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="slug", type="string", length=100, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $slug;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="slug_ar", type="string", length=100, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $slugAr;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="slug_fr", type="string", length=100, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $slugFr;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="mode", type="string", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $mode;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="menu_css", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $menuCss;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="item_css", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $itemCss;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="active_css", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $activeCss;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="not_active_css", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $notActiveCss;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="first_css", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $firstCss;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="last_css", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $lastCss;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="before_txt", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $beforeTxt;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="after_txt", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $afterTxt;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="separator", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $separator;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="columns_number", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $columnsNumber;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="display_mode", type="string", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $displayMode;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="text_position", type="string", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $textPosition;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="is_published", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $isPublished;

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
     * @return Menu
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
     * @return Menu
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
     * @return Menu
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
     * @return Menu
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
     * @return Menu
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
     * @return Menu
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
     * Set mode
     *
     * @access public
     * @param string $mode
     * @return Menu
     */
    public function setMode($mode = null)
    {
        $this->mode = $mode;
        return $this;
    }

    /**
     * Get mode
     *
     * @access public
     * @return string 
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Set menuCss
     *
     * @access public
     * @param string $menuCss
     * @return Menu
     */
    public function setMenuCss($menuCss = null)
    {
        $this->menuCss = $menuCss;
        return $this;
    }

    /**
     * Get menuCss
     *
     * @access public
     * @return string 
     */
    public function getMenuCss()
    {
        return $this->menuCss;
    }

    /**
     * Set itemCss
     *
     * @access public
     * @param string $itemCss
     * @return Menu
     */
    public function setItemCss($itemCss = null)
    {
        $this->itemCss = $itemCss;
        return $this;
    }

    /**
     * Get itemCss
     *
     * @access public
     * @return string 
     */
    public function getItemCss()
    {
        return $this->itemCss;
    }

    /**
     * Set activeCss
     *
     * @access public
     * @param string $activeCss
     * @return Menu
     */
    public function setActiveCss($activeCss = null)
    {
        $this->activeCss = $activeCss;
        return $this;
    }

    /**
     * Get activeCss
     *
     * @access public
     * @return string 
     */
    public function getActiveCss()
    {
        return $this->activeCss;
    }

    /**
     * Set notActiveCss
     *
     * @access public
     * @param string $notActiveCss
     * @return Menu
     */
    public function setNotActiveCss($notActiveCss = null)
    {
        $this->notActiveCss = $notActiveCss;
        return $this;
    }

    /**
     * Get notActiveCss
     *
     * @access public
     * @return string 
     */
    public function getNotActiveCss()
    {
        return $this->notActiveCss;
    }

    /**
     * Set firstCss
     *
     * @access public
     * @param string $firstCss
     * @return Menu
     */
    public function setFirstCss($firstCss = null)
    {
        $this->firstCss = $firstCss;
        return $this;
    }

    /**
     * Get firstCss
     *
     * @access public
     * @return string 
     */
    public function getFirstCss()
    {
        return $this->firstCss;
    }

    /**
     * Set lastCss
     *
     * @access public
     * @param string $lastCss
     * @return Menu
     */
    public function setLastCss($lastCss = null)
    {
        $this->lastCss = $lastCss;
        return $this;
    }

    /**
     * Get lastCss
     *
     * @access public
     * @return string 
     */
    public function getLastCss()
    {
        return $this->lastCss;
    }

    /**
     * Set beforeTxt
     *
     * @access public
     * @param string $beforeTxt
     * @return Menu
     */
    public function setBeforeTxt($beforeTxt = null)
    {
        $this->beforeTxt = $beforeTxt;
        return $this;
    }

    /**
     * Get beforeTxt
     *
     * @access public
     * @return string 
     */
    public function getBeforeTxt()
    {
        return $this->beforeTxt;
    }

    /**
     * Set afterTxt
     *
     * @access public
     * @param string $afterTxt
     * @return Menu
     */
    public function setAfterTxt($afterTxt = null)
    {
        $this->afterTxt = $afterTxt;
        return $this;
    }

    /**
     * Get afterTxt
     *
     * @access public
     * @return string 
     */
    public function getAfterTxt()
    {
        return $this->afterTxt;
    }

    /**
     * Set separator
     *
     * @access public
     * @param string $separator
     * @return Menu
     */
    public function setSeparator($separator = null)
    {
        $this->separator = $separator;
        return $this;
    }

    /**
     * Get separator
     *
     * @access public
     * @return string 
     */
    public function getSeparator()
    {
        return $this->separator;
    }

    /**
     * Set columnsNumber
     *
     * @access public
     * @param integer $columnsNumber
     * @return Menu
     */
    public function setColumnsNumber($columnsNumber = null)
    {
        $this->columnsNumber = $columnsNumber;
        return $this;
    }

    /**
     * Get columnsNumber
     *
     * @access public
     * @return integer 
     */
    public function getColumnsNumber()
    {
        return $this->columnsNumber;
    }

    /**
     * Set displayMode
     *
     * @access public
     * @param string $displayMode
     * @return Menu
     */
    public function setDisplayMode($displayMode)
    {
        $this->displayMode = $displayMode;
        return $this;
    }

    /**
     * Get displayMode
     *
     * @access public
     * @return string 
     */
    public function getDisplayMode()
    {
        return $this->displayMode;
    }

    /**
     * Set textPosition
     *
     * @access public
     * @param string $textPosition
     * @return Menu
     */
    public function setTextPosition($textPosition)
    {
        $this->textPosition = $textPosition;
        return $this;
    }

    /**
     * Get textPosition
     *
     * @access public
     * @return string 
     */
    public function getTextPosition()
    {
        return $this->textPosition;
    }

    /**
     * Set isPublished
     *
     * @access public
     * @param boolean $isPublished
     * @return Menu
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;
        return $this;
    }

    /**
     * Get isPublished
     *
     * @access public
     * @return boolean 
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * Set createdAt
     *
     * @access public
     * @param \DateTime $createdAt
     * @return Menu
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
     * @return Menu
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
     * @param \ContinuousNet\SportClubBundle\Entity\User $creatorUser
     * @return Menu
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
     * @return Menu
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
