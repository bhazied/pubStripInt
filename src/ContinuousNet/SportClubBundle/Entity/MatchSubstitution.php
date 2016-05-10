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
 * Match Substitution Entity
 * 
 * Storing MatchSubstitutions data to the database using Doctrine
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
 * @see        MatchSubstitution
 * @since      Class available since Release 1.0
 * @access     public
 * 
 * @ORM\Table(name="`match_substitution`", indexes={@ORM\Index(name="match_id", columns={"match_id"}), @ORM\Index(name="team_id", columns={"team_id"}), @ORM\Index(name="player_id_in", columns={"player_id_in"}), @ORM\Index(name="player_id_out", columns={"player_id_out"}), @ORM\Index(name="creator_user_id", columns={"creator_user_id"}), @ORM\Index(name="modifier_user_id", columns={"modifier_user_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class MatchSubstitution 
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
     *        @ORM\JoinColumn(name="player_id_in", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $playerIn;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\Player
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="player_id_out", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $playerOut;

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
     * @return MatchSubstitution
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
     * Set createdAt
     *
     * @access public
     * @param \DateTime $createdAt
     * @return MatchSubstitution
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
     * @return MatchSubstitution
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
     * @return MatchSubstitution
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
     * @return MatchSubstitution
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
     * Set playerIn
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Player $playerIn
     * @return MatchSubstitution
     */
    public function setPlayerIn(Player $playerIn = null)
    {
        $this->playerIn = $playerIn;
        return $this;
    }

    /**
     * Get playerIn
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Player 
     */
    public function getPlayerIn()
    {
        return $this->playerIn;
    }

    /**
     * Set playerOut
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Player $playerOut
     * @return MatchSubstitution
     */
    public function setPlayerOut(Player $playerOut = null)
    {
        $this->playerOut = $playerOut;
        return $this;
    }

    /**
     * Get playerOut
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Player 
     */
    public function getPlayerOut()
    {
        return $this->playerOut;
    }

    /**
     * Set creatorUser
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\User $creatorUser
     * @return MatchSubstitution
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
     * @return MatchSubstitution
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
