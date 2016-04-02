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
 * Track Press Release Entity
 * 
 * Storing TrackPressReleases data to the database using Doctrine
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
 * @see        TrackPressRelease
 * @since      Class available since Release 1.0
 * @deprecated Nothing
 * @access     public
 * 
 * @ORM\Table(name="`track_press_release`", indexes={@ORM\Index(name="press_release_id", columns={"press_release_id"}), @ORM\Index(name="creator_user_id", columns={"creator_user_id"}), @ORM\Index(name="modifier_user_id", columns={"modifier_user_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class TrackPressRelease 
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
     * @ORM\Column(name="section", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $section;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="source", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $source;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="action", type="string", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $action;

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
     * @var \ContinuousNet\PubliPrBundle\Entity\PressRelease
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="PressRelease")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="press_release_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $pressRelease;

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
     * Set section
     *
     * @access public
     * @param string $section
     * @return TrackPressRelease
     */
    public function setSection($section = null)
    {
        $this->section = $section;
        return $this;
    }

    /**
     * Get section
     *
     * @access public
     * @return string 
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * Set source
     *
     * @access public
     * @param string $source
     * @return TrackPressRelease
     */
    public function setSource($source = null)
    {
        $this->source = $source;
        return $this;
    }

    /**
     * Get source
     *
     * @access public
     * @return string 
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set action
     *
     * @access public
     * @param string $action
     * @return TrackPressRelease
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * Get action
     *
     * @access public
     * @return string 
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set createdAt
     *
     * @access public
     * @param \DateTime $createdAt
     * @return TrackPressRelease
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
     * @return TrackPressRelease
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
     * Set pressRelease
     *
     * @access public
     * @param \ContinuousNet\PubliPrBundle\Entity\PressRelease $pressRelease
     * @return TrackPressRelease
     */
    public function setPressRelease(PressRelease $pressRelease = null)
    {
        $this->pressRelease = $pressRelease;
        return $this;
    }

    /**
     * Get pressRelease
     *
     * @access public
     * @return \ContinuousNet\PubliPrBundle\Entity\PressRelease 
     */
    public function getPressRelease()
    {
        return $this->pressRelease;
    }

    /**
     * Set creatorUser
     *
     * @access public
     * @param \ContinuousNet\PubliPrBundle\Entity\User $creatorUser
     * @return TrackPressRelease
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
     * @return TrackPressRelease
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
