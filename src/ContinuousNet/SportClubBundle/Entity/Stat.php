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
 * Stat Entity
 * 
 * Storing Stats data to the database using Doctrine
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
 * @see        Stat
 * @since      Class available since Release 1.0
 * @access     public
 * 
 * @ORM\Table(name="`stat`", indexes={@ORM\Index(name="table_id", columns={"table_id"}), @ORM\Index(name="team_id", columns={"team_id"}), @ORM\Index(name="creator_user_id", columns={"creator_user_id"}), @ORM\Index(name="modifier_user_id", columns={"modifier_user_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class Stat 
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
     * @ORM\Column(name="position", type="integer", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $position;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="last_position", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $lastPosition;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="played", type="integer", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $played;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="won", type="integer", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $won;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="drawn", type="integer", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $drawn;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="lost", type="integer", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $lost;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="goals_for", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $goalsFor;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="goals_against", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $goalsAgainst;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="goal_difference", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $goalDifference;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="points", type="integer", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $points;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="mouvement", type="string", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $mouvement;

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
     * @var \ContinuousNet\SportClubBundle\Entity\Table
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Table")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="table_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $table;

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
     * Set position
     *
     * @access public
     * @param integer $position
     * @return Stat
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }

    /**
     * Get position
     *
     * @access public
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set lastPosition
     *
     * @access public
     * @param integer $lastPosition
     * @return Stat
     */
    public function setLastPosition($lastPosition = null)
    {
        $this->lastPosition = $lastPosition;
        return $this;
    }

    /**
     * Get lastPosition
     *
     * @access public
     * @return integer 
     */
    public function getLastPosition()
    {
        return $this->lastPosition;
    }

    /**
     * Set played
     *
     * @access public
     * @param integer $played
     * @return Stat
     */
    public function setPlayed($played)
    {
        $this->played = $played;
        return $this;
    }

    /**
     * Get played
     *
     * @access public
     * @return integer 
     */
    public function getPlayed()
    {
        return $this->played;
    }

    /**
     * Set won
     *
     * @access public
     * @param integer $won
     * @return Stat
     */
    public function setWon($won)
    {
        $this->won = $won;
        return $this;
    }

    /**
     * Get won
     *
     * @access public
     * @return integer 
     */
    public function getWon()
    {
        return $this->won;
    }

    /**
     * Set drawn
     *
     * @access public
     * @param integer $drawn
     * @return Stat
     */
    public function setDrawn($drawn)
    {
        $this->drawn = $drawn;
        return $this;
    }

    /**
     * Get drawn
     *
     * @access public
     * @return integer 
     */
    public function getDrawn()
    {
        return $this->drawn;
    }

    /**
     * Set lost
     *
     * @access public
     * @param integer $lost
     * @return Stat
     */
    public function setLost($lost)
    {
        $this->lost = $lost;
        return $this;
    }

    /**
     * Get lost
     *
     * @access public
     * @return integer 
     */
    public function getLost()
    {
        return $this->lost;
    }

    /**
     * Set goalsFor
     *
     * @access public
     * @param integer $goalsFor
     * @return Stat
     */
    public function setGoalsFor($goalsFor = null)
    {
        $this->goalsFor = $goalsFor;
        return $this;
    }

    /**
     * Get goalsFor
     *
     * @access public
     * @return integer 
     */
    public function getGoalsFor()
    {
        return $this->goalsFor;
    }

    /**
     * Set goalsAgainst
     *
     * @access public
     * @param integer $goalsAgainst
     * @return Stat
     */
    public function setGoalsAgainst($goalsAgainst = null)
    {
        $this->goalsAgainst = $goalsAgainst;
        return $this;
    }

    /**
     * Get goalsAgainst
     *
     * @access public
     * @return integer 
     */
    public function getGoalsAgainst()
    {
        return $this->goalsAgainst;
    }

    /**
     * Set goalDifference
     *
     * @access public
     * @param integer $goalDifference
     * @return Stat
     */
    public function setGoalDifference($goalDifference = null)
    {
        $this->goalDifference = $goalDifference;
        return $this;
    }

    /**
     * Get goalDifference
     *
     * @access public
     * @return integer 
     */
    public function getGoalDifference()
    {
        return $this->goalDifference;
    }

    /**
     * Set points
     *
     * @access public
     * @param integer $points
     * @return Stat
     */
    public function setPoints($points)
    {
        $this->points = $points;
        return $this;
    }

    /**
     * Get points
     *
     * @access public
     * @return integer 
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set mouvement
     *
     * @access public
     * @param string $mouvement
     * @return Stat
     */
    public function setMouvement($mouvement)
    {
        $this->mouvement = $mouvement;
        return $this;
    }

    /**
     * Get mouvement
     *
     * @access public
     * @return string 
     */
    public function getMouvement()
    {
        return $this->mouvement;
    }

    /**
     * Set createdAt
     *
     * @access public
     * @param \DateTime $createdAt
     * @return Stat
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
     * @return Stat
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
     * Set table
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Table $table
     * @return Stat
     */
    public function setTable(Table $table = null)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * Get table
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Table 
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Set team
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Team $team
     * @return Stat
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
     * Set creatorUser
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\User $creatorUser
     * @return Stat
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
     * @return Stat
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
