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
 * Player Stat Entity
 * 
 * Storing PlayerStats data to the database using Doctrine
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
 * @see        PlayerStat
 * @since      Class available since Release 1.0
 * @access     public
 * 
 * @ORM\Table(name="`player_stat`", indexes={@ORM\Index(name="player_id", columns={"player_id"}), @ORM\Index(name="season_id", columns={"season_id"}), @ORM\Index(name="creator_user_id", columns={"creator_user_id"}), @ORM\Index(name="modifier_user_id", columns={"modifier_user_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class PlayerStat 
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
     * @ORM\Column(name="goals", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $goals;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="assists", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $assists;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="matches", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $matches;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="wins", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $wins;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="losts", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $losts;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="minutes", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $minutes;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="starter", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $starter;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="substitue", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $substitue;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="faults_made", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $faultsMade;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="faults_received", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $faultsReceived;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="yellow_cards", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $yellowCards;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="red_cards", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $redCards;

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
     * @var \ContinuousNet\SportClubBundle\Entity\Season
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Season")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="season_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $season;

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
     * Set goals
     *
     * @access public
     * @param integer $goals
     * @return PlayerStat
     */
    public function setGoals($goals = null)
    {
        $this->goals = $goals;
        return $this;
    }

    /**
     * Get goals
     *
     * @access public
     * @return integer 
     */
    public function getGoals()
    {
        return $this->goals;
    }

    /**
     * Set assists
     *
     * @access public
     * @param integer $assists
     * @return PlayerStat
     */
    public function setAssists($assists = null)
    {
        $this->assists = $assists;
        return $this;
    }

    /**
     * Get assists
     *
     * @access public
     * @return integer 
     */
    public function getAssists()
    {
        return $this->assists;
    }

    /**
     * Set matches
     *
     * @access public
     * @param integer $matches
     * @return PlayerStat
     */
    public function setMatches($matches = null)
    {
        $this->matches = $matches;
        return $this;
    }

    /**
     * Get matches
     *
     * @access public
     * @return integer 
     */
    public function getMatches()
    {
        return $this->matches;
    }

    /**
     * Set wins
     *
     * @access public
     * @param integer $wins
     * @return PlayerStat
     */
    public function setWins($wins = null)
    {
        $this->wins = $wins;
        return $this;
    }

    /**
     * Get wins
     *
     * @access public
     * @return integer 
     */
    public function getWins()
    {
        return $this->wins;
    }

    /**
     * Set losts
     *
     * @access public
     * @param integer $losts
     * @return PlayerStat
     */
    public function setLosts($losts = null)
    {
        $this->losts = $losts;
        return $this;
    }

    /**
     * Get losts
     *
     * @access public
     * @return integer 
     */
    public function getLosts()
    {
        return $this->losts;
    }

    /**
     * Set minutes
     *
     * @access public
     * @param integer $minutes
     * @return PlayerStat
     */
    public function setMinutes($minutes = null)
    {
        $this->minutes = $minutes;
        return $this;
    }

    /**
     * Get minutes
     *
     * @access public
     * @return integer 
     */
    public function getMinutes()
    {
        return $this->minutes;
    }

    /**
     * Set starter
     *
     * @access public
     * @param integer $starter
     * @return PlayerStat
     */
    public function setStarter($starter = null)
    {
        $this->starter = $starter;
        return $this;
    }

    /**
     * Get starter
     *
     * @access public
     * @return integer 
     */
    public function getStarter()
    {
        return $this->starter;
    }

    /**
     * Set substitue
     *
     * @access public
     * @param integer $substitue
     * @return PlayerStat
     */
    public function setSubstitue($substitue = null)
    {
        $this->substitue = $substitue;
        return $this;
    }

    /**
     * Get substitue
     *
     * @access public
     * @return integer 
     */
    public function getSubstitue()
    {
        return $this->substitue;
    }

    /**
     * Set faultsMade
     *
     * @access public
     * @param integer $faultsMade
     * @return PlayerStat
     */
    public function setFaultsMade($faultsMade = null)
    {
        $this->faultsMade = $faultsMade;
        return $this;
    }

    /**
     * Get faultsMade
     *
     * @access public
     * @return integer 
     */
    public function getFaultsMade()
    {
        return $this->faultsMade;
    }

    /**
     * Set faultsReceived
     *
     * @access public
     * @param integer $faultsReceived
     * @return PlayerStat
     */
    public function setFaultsReceived($faultsReceived = null)
    {
        $this->faultsReceived = $faultsReceived;
        return $this;
    }

    /**
     * Get faultsReceived
     *
     * @access public
     * @return integer 
     */
    public function getFaultsReceived()
    {
        return $this->faultsReceived;
    }

    /**
     * Set yellowCards
     *
     * @access public
     * @param integer $yellowCards
     * @return PlayerStat
     */
    public function setYellowCards($yellowCards = null)
    {
        $this->yellowCards = $yellowCards;
        return $this;
    }

    /**
     * Get yellowCards
     *
     * @access public
     * @return integer 
     */
    public function getYellowCards()
    {
        return $this->yellowCards;
    }

    /**
     * Set redCards
     *
     * @access public
     * @param integer $redCards
     * @return PlayerStat
     */
    public function setRedCards($redCards = null)
    {
        $this->redCards = $redCards;
        return $this;
    }

    /**
     * Get redCards
     *
     * @access public
     * @return integer 
     */
    public function getRedCards()
    {
        return $this->redCards;
    }

    /**
     * Set createdAt
     *
     * @access public
     * @param \DateTime $createdAt
     * @return PlayerStat
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
     * @return PlayerStat
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
     * Set player
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Player $player
     * @return PlayerStat
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
     * Set season
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Season $season
     * @return PlayerStat
     */
    public function setSeason(Season $season = null)
    {
        $this->season = $season;
        return $this;
    }

    /**
     * Get season
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Season 
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * Set creatorUser
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\User $creatorUser
     * @return PlayerStat
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
     * @return PlayerStat
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
