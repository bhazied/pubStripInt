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
 * Match Goal Entity
 * 
 * Storing MatchGoals data to the database using Doctrine
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
 * @see        MatchGoal
 * @since      Class available since Release 1.0
 * @access     public
 * 
 * @ORM\Table(name="`match_goal`", indexes={@ORM\Index(name="match_id", columns={"match_id"}), @ORM\Index(name="team_id", columns={"team_id"}), @ORM\Index(name="player_id", columns={"player_id"}), @ORM\Index(name="creator_user_id", columns={"creator_user_id"}), @ORM\Index(name="modifier_user_id", columns={"modifier_user_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class MatchGoal 
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
     * @ORM\Column(name="scored_with", type="string", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $scoredWith;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="zone", type="string", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $zone;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="stadium_zone", type="string", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $stadiumZone;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="penalty", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $penalty;

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
     * @var \ContinuousNet\SportClubBundle\Entity\Team
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $team;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\Player
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $player;

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
     * Set minute
     *
     * @access public
     * @param integer $minute
     * @return MatchGoal
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
     * Set scoredWith
     *
     * @access public
     * @param string $scoredWith
     * @return MatchGoal
     */
    public function setScoredWith($scoredWith = null)
    {
        $this->scoredWith = $scoredWith;
        return $this;
    }

    /**
     * Get scoredWith
     *
     * @access public
     * @return string 
     */
    public function getScoredWith()
    {
        return $this->scoredWith;
    }

    /**
     * Set zone
     *
     * @access public
     * @param string $zone
     * @return MatchGoal
     */
    public function setZone($zone = null)
    {
        $this->zone = $zone;
        return $this;
    }

    /**
     * Get zone
     *
     * @access public
     * @return string 
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * Set stadiumZone
     *
     * @access public
     * @param string $stadiumZone
     * @return MatchGoal
     */
    public function setStadiumZone($stadiumZone = null)
    {
        $this->stadiumZone = $stadiumZone;
        return $this;
    }

    /**
     * Get stadiumZone
     *
     * @access public
     * @return string 
     */
    public function getStadiumZone()
    {
        return $this->stadiumZone;
    }

    /**
     * Set penalty
     *
     * @access public
     * @param boolean $penalty
     * @return MatchGoal
     */
    public function setPenalty($penalty)
    {
        $this->penalty = $penalty;
        return $this;
    }

    /**
     * Get penalty
     *
     * @access public
     * @return boolean 
     */
    public function getPenalty()
    {
        return $this->penalty;
    }

    /**
     * Set createdAt
     *
     * @access public
     * @param \DateTime $createdAt
     * @return MatchGoal
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
     * @return MatchGoal
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
     * @return MatchGoal
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
     * Set team
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Team $team
     * @return MatchGoal
     */
    public function setTeam(Team $team = null)
    {
        $this->team = $team;
        return $this;
    }

    /**
     * Get team
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Team 
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set player
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Player $player
     * @return MatchGoal
     */
    public function setPlayer(Player $player = null)
    {
        $this->player = $player;
        return $this;
    }

    /**
     * Get player
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Player 
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * Set creatorUser
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\User $creatorUser
     * @return MatchGoal
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
     * @return MatchGoal
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
