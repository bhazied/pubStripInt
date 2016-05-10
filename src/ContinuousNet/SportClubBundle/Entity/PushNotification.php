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
 * Push Notification Entity
 * 
 * Storing PushNotifications data to the database using Doctrine
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
 * @see        PushNotification
 * @since      Class available since Release 1.0
 * @access     public
 * 
 * @ORM\Table(name="`push_notification`", indexes={@ORM\Index(name="match_id", columns={"match_id"}), @ORM\Index(name="match_substitution_id", columns={"match_substitution_id"}), @ORM\Index(name="match_goal_id", columns={"match_goal_id"}), @ORM\Index(name="post_id", columns={"post_id"}), @ORM\Index(name="video_id", columns={"video_id"}), @ORM\Index(name="audio_id", columns={"audio_id"}), @ORM\Index(name="gallery_id", columns={"gallery_id"}), @ORM\Index(name="creator_user_id", columns={"creator_user_id"}), @ORM\Index(name="modifier_user_id", columns={"modifier_user_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class PushNotification 
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
     * @ORM\Column(name="title", type="string", length=255, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $title;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="title_ar", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $titleAr;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="title_fr", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $titleFr;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="message", type="string", length=500, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $message;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="message_ar", type="string", length=500, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $messageAr;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="message_fr", type="string", length=500, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $messageFr;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="type", type="string", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $type;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="category", type="string", length=50, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $category;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="badge", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $badge;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="sound", type="string", length=100, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $sound;

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
     * @var \ContinuousNet\SportClubBundle\Entity\Match
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Match")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="match_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $match;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\MatchSubstitution
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="MatchSubstitution")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="match_substitution_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $matchSubstitution;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\MatchGoal
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="MatchGoal")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="match_goal_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $matchGoal;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\Post
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Post")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $post;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\Video
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Video")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="video_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $video;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\Audio
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Audio")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="audio_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $audio;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\Gallery
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Gallery")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="gallery_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $gallery;

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
     * Set title
     *
     * @access public
     * @param string $title
     * @return PushNotification
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
     * @return PushNotification
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
     * @return PushNotification
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
     * Set message
     *
     * @access public
     * @param string $message
     * @return PushNotification
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Get message
     *
     * @access public
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set messageAr
     *
     * @access public
     * @param string $messageAr
     * @return PushNotification
     */
    public function setMessageAr($messageAr = null)
    {
        $this->messageAr = $messageAr;
        return $this;
    }

    /**
     * Get messageAr
     *
     * @access public
     * @return string 
     */
    public function getMessageAr()
    {
        return $this->messageAr;
    }

    /**
     * Set messageFr
     *
     * @access public
     * @param string $messageFr
     * @return PushNotification
     */
    public function setMessageFr($messageFr = null)
    {
        $this->messageFr = $messageFr;
        return $this;
    }

    /**
     * Get messageFr
     *
     * @access public
     * @return string 
     */
    public function getMessageFr()
    {
        return $this->messageFr;
    }

    /**
     * Set type
     *
     * @access public
     * @param string $type
     * @return PushNotification
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @access public
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set category
     *
     * @access public
     * @param string $category
     * @return PushNotification
     */
    public function setCategory($category = null)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Get category
     *
     * @access public
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set badge
     *
     * @access public
     * @param integer $badge
     * @return PushNotification
     */
    public function setBadge($badge = null)
    {
        $this->badge = $badge;
        return $this;
    }

    /**
     * Get badge
     *
     * @access public
     * @return integer 
     */
    public function getBadge()
    {
        return $this->badge;
    }

    /**
     * Set sound
     *
     * @access public
     * @param string $sound
     * @return PushNotification
     */
    public function setSound($sound = null)
    {
        $this->sound = $sound;
        return $this;
    }

    /**
     * Get sound
     *
     * @access public
     * @return string 
     */
    public function getSound()
    {
        return $this->sound;
    }

    /**
     * Set createdAt
     *
     * @access public
     * @param \DateTime $createdAt
     * @return PushNotification
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
     * @return PushNotification
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
     * Set match
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Match $match
     * @return PushNotification
     */
    public function setMatch(Match $match = null)
    {
        $this->match = $match;
        return $this;
    }

    /**
     * Get match
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Match 
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * Set matchSubstitution
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\MatchSubstitution $matchSubstitution
     * @return PushNotification
     */
    public function setMatchSubstitution(MatchSubstitution $matchSubstitution = null)
    {
        $this->matchSubstitution = $matchSubstitution;
        return $this;
    }

    /**
     * Get matchSubstitution
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\MatchSubstitution 
     */
    public function getMatchSubstitution()
    {
        return $this->matchSubstitution;
    }

    /**
     * Set matchGoal
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\MatchGoal $matchGoal
     * @return PushNotification
     */
    public function setMatchGoal(MatchGoal $matchGoal = null)
    {
        $this->matchGoal = $matchGoal;
        return $this;
    }

    /**
     * Get matchGoal
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\MatchGoal 
     */
    public function getMatchGoal()
    {
        return $this->matchGoal;
    }

    /**
     * Set post
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Post $post
     * @return PushNotification
     */
    public function setPost(Post $post = null)
    {
        $this->post = $post;
        return $this;
    }

    /**
     * Get post
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Post 
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set video
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Video $video
     * @return PushNotification
     */
    public function setVideo(Video $video = null)
    {
        $this->video = $video;
        return $this;
    }

    /**
     * Get video
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Video 
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set audio
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Audio $audio
     * @return PushNotification
     */
    public function setAudio(Audio $audio = null)
    {
        $this->audio = $audio;
        return $this;
    }

    /**
     * Get audio
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Audio 
     */
    public function getAudio()
    {
        return $this->audio;
    }

    /**
     * Set gallery
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Gallery $gallery
     * @return PushNotification
     */
    public function setGallery(Gallery $gallery = null)
    {
        $this->gallery = $gallery;
        return $this;
    }

    /**
     * Get gallery
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Gallery 
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * Set creatorUser
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\User $creatorUser
     * @return PushNotification
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
     * @return PushNotification
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
