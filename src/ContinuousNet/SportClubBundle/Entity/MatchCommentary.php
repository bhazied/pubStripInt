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
 * Match Commentary Entity
 * 
 * Storing MatchCommentaries data to the database using Doctrine
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
 * @see        MatchCommentary
 * @since      Class available since Release 1.0
 * @access     public
 * 
 * @ORM\Table(name="`match_commentary`", indexes={@ORM\Index(name="match_id", columns={"match_id"}), @ORM\Index(name="creator_user_id", columns={"creator_user_id"}), @ORM\Index(name="modifier_user_id", columns={"modifier_user_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class MatchCommentary 
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
     * @ORM\Column(name="comment", type="string", length=255, nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $comment;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="comment_ar", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $commentAr;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="comment_fr", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $commentFr;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="minute", type="integer", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $minute;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="icon", type="string", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $icon;

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
     * Set comment
     *
     * @access public
     * @param string $comment
     * @return MatchCommentary
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * Get comment
     *
     * @access public
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set commentAr
     *
     * @access public
     * @param string $commentAr
     * @return MatchCommentary
     */
    public function setCommentAr($commentAr = null)
    {
        $this->commentAr = $commentAr;
        return $this;
    }

    /**
     * Get commentAr
     *
     * @access public
     * @return string 
     */
    public function getCommentAr()
    {
        return $this->commentAr;
    }

    /**
     * Set commentFr
     *
     * @access public
     * @param string $commentFr
     * @return MatchCommentary
     */
    public function setCommentFr($commentFr = null)
    {
        $this->commentFr = $commentFr;
        return $this;
    }

    /**
     * Get commentFr
     *
     * @access public
     * @return string 
     */
    public function getCommentFr()
    {
        return $this->commentFr;
    }

    /**
     * Set minute
     *
     * @access public
     * @param integer $minute
     * @return MatchCommentary
     */
    public function setMinute($minute)
    {
        $this->minute = $minute;
        return $this;
    }

    /**
     * Get minute
     *
     * @access public
     * @return integer 
     */
    public function getMinute()
    {
        return $this->minute;
    }

    /**
     * Set icon
     *
     * @access public
     * @param string $icon
     * @return MatchCommentary
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * Get icon
     *
     * @access public
     * @return string 
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set isPublished
     *
     * @access public
     * @param boolean $isPublished
     * @return MatchCommentary
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
     * @return MatchCommentary
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
     * @return MatchCommentary
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
     * @return MatchCommentary
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
     * Set creatorUser
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\User $creatorUser
     * @return MatchCommentary
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
     * @return MatchCommentary
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
