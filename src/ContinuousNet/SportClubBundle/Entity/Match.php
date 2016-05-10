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
 * Match Entity
 * 
 * Storing Matches data to the database using Doctrine
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
 * @see        Match
 * @since      Class available since Release 1.0
 * @access     public
 * 
 * @ORM\Table(name="`match`", indexes={@ORM\Index(name="gallery_id", columns={"gallery_id"}), @ORM\Index(name="show_id", columns={"show_id"}), @ORM\Index(name="day_id", columns={"day_id"}), @ORM\Index(name="team_id_home", columns={"team_id_home"}), @ORM\Index(name="team_id_away", columns={"team_id_away"}), @ORM\Index(name="country_id", columns={"country_id"}), @ORM\Index(name="city_id", columns={"city_id"}), @ORM\Index(name="stadium_id", columns={"stadium_id"}), @ORM\Index(name="creator_user_id", columns={"creator_user_id"}), @ORM\Index(name="modifier_user_id", columns={"modifier_user_id"})})
 * @ORM\Entity
 * @UniqueEntity("name")
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class Match 
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false, unique=true)
     * 
     * @Expose
     * 
     */
    private $name;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="name_ar", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $nameAr;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="name_fr", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $nameFr;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="goals_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $goalsHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="goals_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $goalsAway;

    /**
     * @var \DateTime
     * @access private
     *
     * @ORM\Column(name="date_time", type="datetime", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $dateTime;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="postponed", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $postponed;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="started", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $started;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="ended", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $ended;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="referee", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $referee;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="referee_ar", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $refereeAr;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="referee_fr", type="string", length=255, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $refereeFr;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="total_shots_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $totalShotsHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="total_shots_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $totalShotsAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="shots_on_target_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $shotsOnTargetHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="shots_on_target_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $shotsOnTargetAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="blocked_shots_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $blockedShotsHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="blocked_shots_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $blockedShotsAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="shots_from_outside_the_box_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $shotsFromOutsideTheBoxHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="shots_from_outside_the_box_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $shotsFromOutsideTheBoxAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="shots_from_inside_the_box_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $shotsFromInsideTheBoxHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="shots_from_inside_the_box_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $shotsFromInsideTheBoxAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="shot_accuracy_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $shotAccuracyHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="shot_accuracy_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $shotAccuracyAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="duels_won_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $duelsWonHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="duels_won_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $duelsWonAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="aerial_duels_won_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $aerialDuelsWonHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="aerial_duels_won_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $aerialDuelsWonAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="interceptions_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $interceptionsHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="interceptions_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $interceptionsAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="total_passes_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $totalPassesHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="total_passes_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $totalPassesAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="passes_long_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $passesLongHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="passes_long_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $passesLongAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="passing_accuracy_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $passingAccuracyHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="passing_accuracy_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $passingAccuracyAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="passing_accuracy_opposition_half_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $passingAccuracyOppositionHalfHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="passing_accuracy_opposition_half_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $passingAccuracyOppositionHalfAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="total_crosses_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $totalCrossesHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="total_crosses_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $totalCrossesAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="successful_crosses_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $successfulCrossesHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="successful_crosses_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $successfulCrossesAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="tackles_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $tacklesHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="tackles_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $tacklesAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="tackles_won_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $tacklesWonHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="tackles_won_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $tacklesWonAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="clearances_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $clearancesHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="clearances_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $clearancesAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="fouls_won_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $foulsWonHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="fouls_won_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $foulsWonAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="fouls_conceded_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $foulsConcededHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="fouls_conceded_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $foulsConcededAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="possession_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $possessionHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="possession_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $possessionAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="substitutions_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $substitutionsHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="substitutions_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $substitutionsAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="penalty_goals_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $penaltyGoalsHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="penalty_goals_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $penaltyGoalsAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="offsides_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $offsidesHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="offsides_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $offsidesAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="corners_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $cornersHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="corners_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $cornersAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="penalties_won_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $penaltiesWonHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="penalties_won_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $penaltiesWonAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="injured_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $injuredHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="injured_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $injuredAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="cards_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $cardsHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="cards_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $cardsAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="yellow_cards_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $yellowCardsHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="yellow_cards_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $yellowCardsAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="double_yellow_cards_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $doubleYellowCardsHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="double_yellow_cards_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $doubleYellowCardsAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="red_cards_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $redCardsHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="red_cards_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $redCardsAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="recovered_balls_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $recoveredBallsHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="recovered_balls_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $recoveredBallsAway;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="turnovers_home", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $turnoversHome;

    /**
     * @var integer
     * @access private
     *
     * @ORM\Column(name="turnovers_away", type="integer", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $turnoversAway;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="previous", type="text", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $previous;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="previous_ar", type="text", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $previousAr;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="previous_fr", type="text", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $previousFr;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="report", type="text", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $report;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="report_ar", type="text", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $reportAr;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="report_fr", type="text", nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $reportFr;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="status", type="string", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $status;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="is_headline", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $isHeadline;

    /**
     * @var boolean
     * @access private
     *
     * @ORM\Column(name="live", type="boolean", nullable=false, unique=false)
     * 
     * @Expose
     * 
     */
    private $live;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="last_minute", type="string", length=3, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $lastMinute;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="ticketing_link", type="string", length=320, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $ticketingLink;

    /**
     * @var string
     * @access private
     *
     * @ORM\Column(name="live_stream", type="string", length=100, nullable=true, unique=false)
     * 
     * @Expose
     * 
     */
    private $liveStream;

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
     * @var \ContinuousNet\SportClubBundle\Entity\Show
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Show")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="show_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $show;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\Day
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Day")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="day_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $day;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\Team
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="team_id_home", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $teamHome;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\Team
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="team_id_away", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $teamAway;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\Country
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $country;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\City
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $city;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\Stadium
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Stadium")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="stadium_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $stadium;

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
     * @return Match
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
     * @return Match
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
     * @return Match
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
     * Set goalsHome
     *
     * @access public
     * @param integer $goalsHome
     * @return Match
     */
    public function setGoalsHome($goalsHome = null)
    {
        $this->goalsHome = $goalsHome;
        return $this;
    }

    /**
     * Get goalsHome
     *
     * @access public
     * @return integer 
     */
    public function getGoalsHome()
    {
        return $this->goalsHome;
    }

    /**
     * Set goalsAway
     *
     * @access public
     * @param integer $goalsAway
     * @return Match
     */
    public function setGoalsAway($goalsAway = null)
    {
        $this->goalsAway = $goalsAway;
        return $this;
    }

    /**
     * Get goalsAway
     *
     * @access public
     * @return integer 
     */
    public function getGoalsAway()
    {
        return $this->goalsAway;
    }

    /**
     * Set dateTime
     *
     * @access public
     * @param \DateTime $dateTime
     * @return Match
     */
    public function setDateTime(\DateTime $dateTime)
    {
        $this->dateTime = $dateTime;
        return $this;
    }

    /**
     * Get dateTime
     *
     * @access public
     * @return \DateTime 
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * Set postponed
     *
     * @access public
     * @param boolean $postponed
     * @return Match
     */
    public function setPostponed($postponed)
    {
        $this->postponed = $postponed;
        return $this;
    }

    /**
     * Get postponed
     *
     * @access public
     * @return boolean 
     */
    public function getPostponed()
    {
        return $this->postponed;
    }

    /**
     * Set started
     *
     * @access public
     * @param boolean $started
     * @return Match
     */
    public function setStarted($started)
    {
        $this->started = $started;
        return $this;
    }

    /**
     * Get started
     *
     * @access public
     * @return boolean 
     */
    public function getStarted()
    {
        return $this->started;
    }

    /**
     * Set ended
     *
     * @access public
     * @param boolean $ended
     * @return Match
     */
    public function setEnded($ended)
    {
        $this->ended = $ended;
        return $this;
    }

    /**
     * Get ended
     *
     * @access public
     * @return boolean 
     */
    public function getEnded()
    {
        return $this->ended;
    }

    /**
     * Set referee
     *
     * @access public
     * @param string $referee
     * @return Match
     */
    public function setReferee($referee = null)
    {
        $this->referee = $referee;
        return $this;
    }

    /**
     * Get referee
     *
     * @access public
     * @return string 
     */
    public function getReferee()
    {
        return $this->referee;
    }

    /**
     * Set refereeAr
     *
     * @access public
     * @param string $refereeAr
     * @return Match
     */
    public function setRefereeAr($refereeAr = null)
    {
        $this->refereeAr = $refereeAr;
        return $this;
    }

    /**
     * Get refereeAr
     *
     * @access public
     * @return string 
     */
    public function getRefereeAr()
    {
        return $this->refereeAr;
    }

    /**
     * Set refereeFr
     *
     * @access public
     * @param string $refereeFr
     * @return Match
     */
    public function setRefereeFr($refereeFr = null)
    {
        $this->refereeFr = $refereeFr;
        return $this;
    }

    /**
     * Get refereeFr
     *
     * @access public
     * @return string 
     */
    public function getRefereeFr()
    {
        return $this->refereeFr;
    }

    /**
     * Set totalShotsHome
     *
     * @access public
     * @param integer $totalShotsHome
     * @return Match
     */
    public function setTotalShotsHome($totalShotsHome = null)
    {
        $this->totalShotsHome = $totalShotsHome;
        return $this;
    }

    /**
     * Get totalShotsHome
     *
     * @access public
     * @return integer 
     */
    public function getTotalShotsHome()
    {
        return $this->totalShotsHome;
    }

    /**
     * Set totalShotsAway
     *
     * @access public
     * @param integer $totalShotsAway
     * @return Match
     */
    public function setTotalShotsAway($totalShotsAway = null)
    {
        $this->totalShotsAway = $totalShotsAway;
        return $this;
    }

    /**
     * Get totalShotsAway
     *
     * @access public
     * @return integer 
     */
    public function getTotalShotsAway()
    {
        return $this->totalShotsAway;
    }

    /**
     * Set shotsOnTargetHome
     *
     * @access public
     * @param integer $shotsOnTargetHome
     * @return Match
     */
    public function setShotsOnTargetHome($shotsOnTargetHome = null)
    {
        $this->shotsOnTargetHome = $shotsOnTargetHome;
        return $this;
    }

    /**
     * Get shotsOnTargetHome
     *
     * @access public
     * @return integer 
     */
    public function getShotsOnTargetHome()
    {
        return $this->shotsOnTargetHome;
    }

    /**
     * Set shotsOnTargetAway
     *
     * @access public
     * @param integer $shotsOnTargetAway
     * @return Match
     */
    public function setShotsOnTargetAway($shotsOnTargetAway = null)
    {
        $this->shotsOnTargetAway = $shotsOnTargetAway;
        return $this;
    }

    /**
     * Get shotsOnTargetAway
     *
     * @access public
     * @return integer 
     */
    public function getShotsOnTargetAway()
    {
        return $this->shotsOnTargetAway;
    }

    /**
     * Set blockedShotsHome
     *
     * @access public
     * @param integer $blockedShotsHome
     * @return Match
     */
    public function setBlockedShotsHome($blockedShotsHome = null)
    {
        $this->blockedShotsHome = $blockedShotsHome;
        return $this;
    }

    /**
     * Get blockedShotsHome
     *
     * @access public
     * @return integer 
     */
    public function getBlockedShotsHome()
    {
        return $this->blockedShotsHome;
    }

    /**
     * Set blockedShotsAway
     *
     * @access public
     * @param integer $blockedShotsAway
     * @return Match
     */
    public function setBlockedShotsAway($blockedShotsAway = null)
    {
        $this->blockedShotsAway = $blockedShotsAway;
        return $this;
    }

    /**
     * Get blockedShotsAway
     *
     * @access public
     * @return integer 
     */
    public function getBlockedShotsAway()
    {
        return $this->blockedShotsAway;
    }

    /**
     * Set shotsFromOutsideTheBoxHome
     *
     * @access public
     * @param integer $shotsFromOutsideTheBoxHome
     * @return Match
     */
    public function setShotsFromOutsideTheBoxHome($shotsFromOutsideTheBoxHome = null)
    {
        $this->shotsFromOutsideTheBoxHome = $shotsFromOutsideTheBoxHome;
        return $this;
    }

    /**
     * Get shotsFromOutsideTheBoxHome
     *
     * @access public
     * @return integer 
     */
    public function getShotsFromOutsideTheBoxHome()
    {
        return $this->shotsFromOutsideTheBoxHome;
    }

    /**
     * Set shotsFromOutsideTheBoxAway
     *
     * @access public
     * @param integer $shotsFromOutsideTheBoxAway
     * @return Match
     */
    public function setShotsFromOutsideTheBoxAway($shotsFromOutsideTheBoxAway = null)
    {
        $this->shotsFromOutsideTheBoxAway = $shotsFromOutsideTheBoxAway;
        return $this;
    }

    /**
     * Get shotsFromOutsideTheBoxAway
     *
     * @access public
     * @return integer 
     */
    public function getShotsFromOutsideTheBoxAway()
    {
        return $this->shotsFromOutsideTheBoxAway;
    }

    /**
     * Set shotsFromInsideTheBoxHome
     *
     * @access public
     * @param integer $shotsFromInsideTheBoxHome
     * @return Match
     */
    public function setShotsFromInsideTheBoxHome($shotsFromInsideTheBoxHome = null)
    {
        $this->shotsFromInsideTheBoxHome = $shotsFromInsideTheBoxHome;
        return $this;
    }

    /**
     * Get shotsFromInsideTheBoxHome
     *
     * @access public
     * @return integer 
     */
    public function getShotsFromInsideTheBoxHome()
    {
        return $this->shotsFromInsideTheBoxHome;
    }

    /**
     * Set shotsFromInsideTheBoxAway
     *
     * @access public
     * @param integer $shotsFromInsideTheBoxAway
     * @return Match
     */
    public function setShotsFromInsideTheBoxAway($shotsFromInsideTheBoxAway = null)
    {
        $this->shotsFromInsideTheBoxAway = $shotsFromInsideTheBoxAway;
        return $this;
    }

    /**
     * Get shotsFromInsideTheBoxAway
     *
     * @access public
     * @return integer 
     */
    public function getShotsFromInsideTheBoxAway()
    {
        return $this->shotsFromInsideTheBoxAway;
    }

    /**
     * Set shotAccuracyHome
     *
     * @access public
     * @param integer $shotAccuracyHome
     * @return Match
     */
    public function setShotAccuracyHome($shotAccuracyHome = null)
    {
        $this->shotAccuracyHome = $shotAccuracyHome;
        return $this;
    }

    /**
     * Get shotAccuracyHome
     *
     * @access public
     * @return integer 
     */
    public function getShotAccuracyHome()
    {
        return $this->shotAccuracyHome;
    }

    /**
     * Set shotAccuracyAway
     *
     * @access public
     * @param integer $shotAccuracyAway
     * @return Match
     */
    public function setShotAccuracyAway($shotAccuracyAway = null)
    {
        $this->shotAccuracyAway = $shotAccuracyAway;
        return $this;
    }

    /**
     * Get shotAccuracyAway
     *
     * @access public
     * @return integer 
     */
    public function getShotAccuracyAway()
    {
        return $this->shotAccuracyAway;
    }

    /**
     * Set duelsWonHome
     *
     * @access public
     * @param integer $duelsWonHome
     * @return Match
     */
    public function setDuelsWonHome($duelsWonHome = null)
    {
        $this->duelsWonHome = $duelsWonHome;
        return $this;
    }

    /**
     * Get duelsWonHome
     *
     * @access public
     * @return integer 
     */
    public function getDuelsWonHome()
    {
        return $this->duelsWonHome;
    }

    /**
     * Set duelsWonAway
     *
     * @access public
     * @param integer $duelsWonAway
     * @return Match
     */
    public function setDuelsWonAway($duelsWonAway = null)
    {
        $this->duelsWonAway = $duelsWonAway;
        return $this;
    }

    /**
     * Get duelsWonAway
     *
     * @access public
     * @return integer 
     */
    public function getDuelsWonAway()
    {
        return $this->duelsWonAway;
    }

    /**
     * Set aerialDuelsWonHome
     *
     * @access public
     * @param integer $aerialDuelsWonHome
     * @return Match
     */
    public function setAerialDuelsWonHome($aerialDuelsWonHome = null)
    {
        $this->aerialDuelsWonHome = $aerialDuelsWonHome;
        return $this;
    }

    /**
     * Get aerialDuelsWonHome
     *
     * @access public
     * @return integer 
     */
    public function getAerialDuelsWonHome()
    {
        return $this->aerialDuelsWonHome;
    }

    /**
     * Set aerialDuelsWonAway
     *
     * @access public
     * @param integer $aerialDuelsWonAway
     * @return Match
     */
    public function setAerialDuelsWonAway($aerialDuelsWonAway = null)
    {
        $this->aerialDuelsWonAway = $aerialDuelsWonAway;
        return $this;
    }

    /**
     * Get aerialDuelsWonAway
     *
     * @access public
     * @return integer 
     */
    public function getAerialDuelsWonAway()
    {
        return $this->aerialDuelsWonAway;
    }

    /**
     * Set interceptionsHome
     *
     * @access public
     * @param integer $interceptionsHome
     * @return Match
     */
    public function setInterceptionsHome($interceptionsHome = null)
    {
        $this->interceptionsHome = $interceptionsHome;
        return $this;
    }

    /**
     * Get interceptionsHome
     *
     * @access public
     * @return integer 
     */
    public function getInterceptionsHome()
    {
        return $this->interceptionsHome;
    }

    /**
     * Set interceptionsAway
     *
     * @access public
     * @param integer $interceptionsAway
     * @return Match
     */
    public function setInterceptionsAway($interceptionsAway = null)
    {
        $this->interceptionsAway = $interceptionsAway;
        return $this;
    }

    /**
     * Get interceptionsAway
     *
     * @access public
     * @return integer 
     */
    public function getInterceptionsAway()
    {
        return $this->interceptionsAway;
    }

    /**
     * Set totalPassesHome
     *
     * @access public
     * @param integer $totalPassesHome
     * @return Match
     */
    public function setTotalPassesHome($totalPassesHome = null)
    {
        $this->totalPassesHome = $totalPassesHome;
        return $this;
    }

    /**
     * Get totalPassesHome
     *
     * @access public
     * @return integer 
     */
    public function getTotalPassesHome()
    {
        return $this->totalPassesHome;
    }

    /**
     * Set totalPassesAway
     *
     * @access public
     * @param integer $totalPassesAway
     * @return Match
     */
    public function setTotalPassesAway($totalPassesAway = null)
    {
        $this->totalPassesAway = $totalPassesAway;
        return $this;
    }

    /**
     * Get totalPassesAway
     *
     * @access public
     * @return integer 
     */
    public function getTotalPassesAway()
    {
        return $this->totalPassesAway;
    }

    /**
     * Set passesLongHome
     *
     * @access public
     * @param integer $passesLongHome
     * @return Match
     */
    public function setPassesLongHome($passesLongHome = null)
    {
        $this->passesLongHome = $passesLongHome;
        return $this;
    }

    /**
     * Get passesLongHome
     *
     * @access public
     * @return integer 
     */
    public function getPassesLongHome()
    {
        return $this->passesLongHome;
    }

    /**
     * Set passesLongAway
     *
     * @access public
     * @param integer $passesLongAway
     * @return Match
     */
    public function setPassesLongAway($passesLongAway = null)
    {
        $this->passesLongAway = $passesLongAway;
        return $this;
    }

    /**
     * Get passesLongAway
     *
     * @access public
     * @return integer 
     */
    public function getPassesLongAway()
    {
        return $this->passesLongAway;
    }

    /**
     * Set passingAccuracyHome
     *
     * @access public
     * @param integer $passingAccuracyHome
     * @return Match
     */
    public function setPassingAccuracyHome($passingAccuracyHome = null)
    {
        $this->passingAccuracyHome = $passingAccuracyHome;
        return $this;
    }

    /**
     * Get passingAccuracyHome
     *
     * @access public
     * @return integer 
     */
    public function getPassingAccuracyHome()
    {
        return $this->passingAccuracyHome;
    }

    /**
     * Set passingAccuracyAway
     *
     * @access public
     * @param integer $passingAccuracyAway
     * @return Match
     */
    public function setPassingAccuracyAway($passingAccuracyAway = null)
    {
        $this->passingAccuracyAway = $passingAccuracyAway;
        return $this;
    }

    /**
     * Get passingAccuracyAway
     *
     * @access public
     * @return integer 
     */
    public function getPassingAccuracyAway()
    {
        return $this->passingAccuracyAway;
    }

    /**
     * Set passingAccuracyOppositionHalfHome
     *
     * @access public
     * @param integer $passingAccuracyOppositionHalfHome
     * @return Match
     */
    public function setPassingAccuracyOppositionHalfHome($passingAccuracyOppositionHalfHome = null)
    {
        $this->passingAccuracyOppositionHalfHome = $passingAccuracyOppositionHalfHome;
        return $this;
    }

    /**
     * Get passingAccuracyOppositionHalfHome
     *
     * @access public
     * @return integer 
     */
    public function getPassingAccuracyOppositionHalfHome()
    {
        return $this->passingAccuracyOppositionHalfHome;
    }

    /**
     * Set passingAccuracyOppositionHalfAway
     *
     * @access public
     * @param integer $passingAccuracyOppositionHalfAway
     * @return Match
     */
    public function setPassingAccuracyOppositionHalfAway($passingAccuracyOppositionHalfAway = null)
    {
        $this->passingAccuracyOppositionHalfAway = $passingAccuracyOppositionHalfAway;
        return $this;
    }

    /**
     * Get passingAccuracyOppositionHalfAway
     *
     * @access public
     * @return integer 
     */
    public function getPassingAccuracyOppositionHalfAway()
    {
        return $this->passingAccuracyOppositionHalfAway;
    }

    /**
     * Set totalCrossesHome
     *
     * @access public
     * @param integer $totalCrossesHome
     * @return Match
     */
    public function setTotalCrossesHome($totalCrossesHome = null)
    {
        $this->totalCrossesHome = $totalCrossesHome;
        return $this;
    }

    /**
     * Get totalCrossesHome
     *
     * @access public
     * @return integer 
     */
    public function getTotalCrossesHome()
    {
        return $this->totalCrossesHome;
    }

    /**
     * Set totalCrossesAway
     *
     * @access public
     * @param integer $totalCrossesAway
     * @return Match
     */
    public function setTotalCrossesAway($totalCrossesAway = null)
    {
        $this->totalCrossesAway = $totalCrossesAway;
        return $this;
    }

    /**
     * Get totalCrossesAway
     *
     * @access public
     * @return integer 
     */
    public function getTotalCrossesAway()
    {
        return $this->totalCrossesAway;
    }

    /**
     * Set successfulCrossesHome
     *
     * @access public
     * @param integer $successfulCrossesHome
     * @return Match
     */
    public function setSuccessfulCrossesHome($successfulCrossesHome = null)
    {
        $this->successfulCrossesHome = $successfulCrossesHome;
        return $this;
    }

    /**
     * Get successfulCrossesHome
     *
     * @access public
     * @return integer 
     */
    public function getSuccessfulCrossesHome()
    {
        return $this->successfulCrossesHome;
    }

    /**
     * Set successfulCrossesAway
     *
     * @access public
     * @param integer $successfulCrossesAway
     * @return Match
     */
    public function setSuccessfulCrossesAway($successfulCrossesAway = null)
    {
        $this->successfulCrossesAway = $successfulCrossesAway;
        return $this;
    }

    /**
     * Get successfulCrossesAway
     *
     * @access public
     * @return integer 
     */
    public function getSuccessfulCrossesAway()
    {
        return $this->successfulCrossesAway;
    }

    /**
     * Set tacklesHome
     *
     * @access public
     * @param integer $tacklesHome
     * @return Match
     */
    public function setTacklesHome($tacklesHome = null)
    {
        $this->tacklesHome = $tacklesHome;
        return $this;
    }

    /**
     * Get tacklesHome
     *
     * @access public
     * @return integer 
     */
    public function getTacklesHome()
    {
        return $this->tacklesHome;
    }

    /**
     * Set tacklesAway
     *
     * @access public
     * @param integer $tacklesAway
     * @return Match
     */
    public function setTacklesAway($tacklesAway = null)
    {
        $this->tacklesAway = $tacklesAway;
        return $this;
    }

    /**
     * Get tacklesAway
     *
     * @access public
     * @return integer 
     */
    public function getTacklesAway()
    {
        return $this->tacklesAway;
    }

    /**
     * Set tacklesWonHome
     *
     * @access public
     * @param integer $tacklesWonHome
     * @return Match
     */
    public function setTacklesWonHome($tacklesWonHome = null)
    {
        $this->tacklesWonHome = $tacklesWonHome;
        return $this;
    }

    /**
     * Get tacklesWonHome
     *
     * @access public
     * @return integer 
     */
    public function getTacklesWonHome()
    {
        return $this->tacklesWonHome;
    }

    /**
     * Set tacklesWonAway
     *
     * @access public
     * @param integer $tacklesWonAway
     * @return Match
     */
    public function setTacklesWonAway($tacklesWonAway = null)
    {
        $this->tacklesWonAway = $tacklesWonAway;
        return $this;
    }

    /**
     * Get tacklesWonAway
     *
     * @access public
     * @return integer 
     */
    public function getTacklesWonAway()
    {
        return $this->tacklesWonAway;
    }

    /**
     * Set clearancesHome
     *
     * @access public
     * @param integer $clearancesHome
     * @return Match
     */
    public function setClearancesHome($clearancesHome = null)
    {
        $this->clearancesHome = $clearancesHome;
        return $this;
    }

    /**
     * Get clearancesHome
     *
     * @access public
     * @return integer 
     */
    public function getClearancesHome()
    {
        return $this->clearancesHome;
    }

    /**
     * Set clearancesAway
     *
     * @access public
     * @param integer $clearancesAway
     * @return Match
     */
    public function setClearancesAway($clearancesAway = null)
    {
        $this->clearancesAway = $clearancesAway;
        return $this;
    }

    /**
     * Get clearancesAway
     *
     * @access public
     * @return integer 
     */
    public function getClearancesAway()
    {
        return $this->clearancesAway;
    }

    /**
     * Set foulsWonHome
     *
     * @access public
     * @param integer $foulsWonHome
     * @return Match
     */
    public function setFoulsWonHome($foulsWonHome = null)
    {
        $this->foulsWonHome = $foulsWonHome;
        return $this;
    }

    /**
     * Get foulsWonHome
     *
     * @access public
     * @return integer 
     */
    public function getFoulsWonHome()
    {
        return $this->foulsWonHome;
    }

    /**
     * Set foulsWonAway
     *
     * @access public
     * @param integer $foulsWonAway
     * @return Match
     */
    public function setFoulsWonAway($foulsWonAway = null)
    {
        $this->foulsWonAway = $foulsWonAway;
        return $this;
    }

    /**
     * Get foulsWonAway
     *
     * @access public
     * @return integer 
     */
    public function getFoulsWonAway()
    {
        return $this->foulsWonAway;
    }

    /**
     * Set foulsConcededHome
     *
     * @access public
     * @param integer $foulsConcededHome
     * @return Match
     */
    public function setFoulsConcededHome($foulsConcededHome = null)
    {
        $this->foulsConcededHome = $foulsConcededHome;
        return $this;
    }

    /**
     * Get foulsConcededHome
     *
     * @access public
     * @return integer 
     */
    public function getFoulsConcededHome()
    {
        return $this->foulsConcededHome;
    }

    /**
     * Set foulsConcededAway
     *
     * @access public
     * @param integer $foulsConcededAway
     * @return Match
     */
    public function setFoulsConcededAway($foulsConcededAway = null)
    {
        $this->foulsConcededAway = $foulsConcededAway;
        return $this;
    }

    /**
     * Get foulsConcededAway
     *
     * @access public
     * @return integer 
     */
    public function getFoulsConcededAway()
    {
        return $this->foulsConcededAway;
    }

    /**
     * Set possessionHome
     *
     * @access public
     * @param integer $possessionHome
     * @return Match
     */
    public function setPossessionHome($possessionHome = null)
    {
        $this->possessionHome = $possessionHome;
        return $this;
    }

    /**
     * Get possessionHome
     *
     * @access public
     * @return integer 
     */
    public function getPossessionHome()
    {
        return $this->possessionHome;
    }

    /**
     * Set possessionAway
     *
     * @access public
     * @param integer $possessionAway
     * @return Match
     */
    public function setPossessionAway($possessionAway = null)
    {
        $this->possessionAway = $possessionAway;
        return $this;
    }

    /**
     * Get possessionAway
     *
     * @access public
     * @return integer 
     */
    public function getPossessionAway()
    {
        return $this->possessionAway;
    }

    /**
     * Set substitutionsHome
     *
     * @access public
     * @param integer $substitutionsHome
     * @return Match
     */
    public function setSubstitutionsHome($substitutionsHome = null)
    {
        $this->substitutionsHome = $substitutionsHome;
        return $this;
    }

    /**
     * Get substitutionsHome
     *
     * @access public
     * @return integer 
     */
    public function getSubstitutionsHome()
    {
        return $this->substitutionsHome;
    }

    /**
     * Set substitutionsAway
     *
     * @access public
     * @param integer $substitutionsAway
     * @return Match
     */
    public function setSubstitutionsAway($substitutionsAway = null)
    {
        $this->substitutionsAway = $substitutionsAway;
        return $this;
    }

    /**
     * Get substitutionsAway
     *
     * @access public
     * @return integer 
     */
    public function getSubstitutionsAway()
    {
        return $this->substitutionsAway;
    }

    /**
     * Set penaltyGoalsHome
     *
     * @access public
     * @param integer $penaltyGoalsHome
     * @return Match
     */
    public function setPenaltyGoalsHome($penaltyGoalsHome = null)
    {
        $this->penaltyGoalsHome = $penaltyGoalsHome;
        return $this;
    }

    /**
     * Get penaltyGoalsHome
     *
     * @access public
     * @return integer 
     */
    public function getPenaltyGoalsHome()
    {
        return $this->penaltyGoalsHome;
    }

    /**
     * Set penaltyGoalsAway
     *
     * @access public
     * @param integer $penaltyGoalsAway
     * @return Match
     */
    public function setPenaltyGoalsAway($penaltyGoalsAway = null)
    {
        $this->penaltyGoalsAway = $penaltyGoalsAway;
        return $this;
    }

    /**
     * Get penaltyGoalsAway
     *
     * @access public
     * @return integer 
     */
    public function getPenaltyGoalsAway()
    {
        return $this->penaltyGoalsAway;
    }

    /**
     * Set offsidesHome
     *
     * @access public
     * @param integer $offsidesHome
     * @return Match
     */
    public function setOffsidesHome($offsidesHome = null)
    {
        $this->offsidesHome = $offsidesHome;
        return $this;
    }

    /**
     * Get offsidesHome
     *
     * @access public
     * @return integer 
     */
    public function getOffsidesHome()
    {
        return $this->offsidesHome;
    }

    /**
     * Set offsidesAway
     *
     * @access public
     * @param integer $offsidesAway
     * @return Match
     */
    public function setOffsidesAway($offsidesAway = null)
    {
        $this->offsidesAway = $offsidesAway;
        return $this;
    }

    /**
     * Get offsidesAway
     *
     * @access public
     * @return integer 
     */
    public function getOffsidesAway()
    {
        return $this->offsidesAway;
    }

    /**
     * Set cornersHome
     *
     * @access public
     * @param integer $cornersHome
     * @return Match
     */
    public function setCornersHome($cornersHome = null)
    {
        $this->cornersHome = $cornersHome;
        return $this;
    }

    /**
     * Get cornersHome
     *
     * @access public
     * @return integer 
     */
    public function getCornersHome()
    {
        return $this->cornersHome;
    }

    /**
     * Set cornersAway
     *
     * @access public
     * @param integer $cornersAway
     * @return Match
     */
    public function setCornersAway($cornersAway = null)
    {
        $this->cornersAway = $cornersAway;
        return $this;
    }

    /**
     * Get cornersAway
     *
     * @access public
     * @return integer 
     */
    public function getCornersAway()
    {
        return $this->cornersAway;
    }

    /**
     * Set penaltiesWonHome
     *
     * @access public
     * @param integer $penaltiesWonHome
     * @return Match
     */
    public function setPenaltiesWonHome($penaltiesWonHome = null)
    {
        $this->penaltiesWonHome = $penaltiesWonHome;
        return $this;
    }

    /**
     * Get penaltiesWonHome
     *
     * @access public
     * @return integer 
     */
    public function getPenaltiesWonHome()
    {
        return $this->penaltiesWonHome;
    }

    /**
     * Set penaltiesWonAway
     *
     * @access public
     * @param integer $penaltiesWonAway
     * @return Match
     */
    public function setPenaltiesWonAway($penaltiesWonAway = null)
    {
        $this->penaltiesWonAway = $penaltiesWonAway;
        return $this;
    }

    /**
     * Get penaltiesWonAway
     *
     * @access public
     * @return integer 
     */
    public function getPenaltiesWonAway()
    {
        return $this->penaltiesWonAway;
    }

    /**
     * Set injuredHome
     *
     * @access public
     * @param integer $injuredHome
     * @return Match
     */
    public function setInjuredHome($injuredHome = null)
    {
        $this->injuredHome = $injuredHome;
        return $this;
    }

    /**
     * Get injuredHome
     *
     * @access public
     * @return integer 
     */
    public function getInjuredHome()
    {
        return $this->injuredHome;
    }

    /**
     * Set injuredAway
     *
     * @access public
     * @param integer $injuredAway
     * @return Match
     */
    public function setInjuredAway($injuredAway = null)
    {
        $this->injuredAway = $injuredAway;
        return $this;
    }

    /**
     * Get injuredAway
     *
     * @access public
     * @return integer 
     */
    public function getInjuredAway()
    {
        return $this->injuredAway;
    }

    /**
     * Set cardsHome
     *
     * @access public
     * @param integer $cardsHome
     * @return Match
     */
    public function setCardsHome($cardsHome = null)
    {
        $this->cardsHome = $cardsHome;
        return $this;
    }

    /**
     * Get cardsHome
     *
     * @access public
     * @return integer 
     */
    public function getCardsHome()
    {
        return $this->cardsHome;
    }

    /**
     * Set cardsAway
     *
     * @access public
     * @param integer $cardsAway
     * @return Match
     */
    public function setCardsAway($cardsAway = null)
    {
        $this->cardsAway = $cardsAway;
        return $this;
    }

    /**
     * Get cardsAway
     *
     * @access public
     * @return integer 
     */
    public function getCardsAway()
    {
        return $this->cardsAway;
    }

    /**
     * Set yellowCardsHome
     *
     * @access public
     * @param integer $yellowCardsHome
     * @return Match
     */
    public function setYellowCardsHome($yellowCardsHome = null)
    {
        $this->yellowCardsHome = $yellowCardsHome;
        return $this;
    }

    /**
     * Get yellowCardsHome
     *
     * @access public
     * @return integer 
     */
    public function getYellowCardsHome()
    {
        return $this->yellowCardsHome;
    }

    /**
     * Set yellowCardsAway
     *
     * @access public
     * @param integer $yellowCardsAway
     * @return Match
     */
    public function setYellowCardsAway($yellowCardsAway = null)
    {
        $this->yellowCardsAway = $yellowCardsAway;
        return $this;
    }

    /**
     * Get yellowCardsAway
     *
     * @access public
     * @return integer 
     */
    public function getYellowCardsAway()
    {
        return $this->yellowCardsAway;
    }

    /**
     * Set doubleYellowCardsHome
     *
     * @access public
     * @param integer $doubleYellowCardsHome
     * @return Match
     */
    public function setDoubleYellowCardsHome($doubleYellowCardsHome = null)
    {
        $this->doubleYellowCardsHome = $doubleYellowCardsHome;
        return $this;
    }

    /**
     * Get doubleYellowCardsHome
     *
     * @access public
     * @return integer 
     */
    public function getDoubleYellowCardsHome()
    {
        return $this->doubleYellowCardsHome;
    }

    /**
     * Set doubleYellowCardsAway
     *
     * @access public
     * @param integer $doubleYellowCardsAway
     * @return Match
     */
    public function setDoubleYellowCardsAway($doubleYellowCardsAway = null)
    {
        $this->doubleYellowCardsAway = $doubleYellowCardsAway;
        return $this;
    }

    /**
     * Get doubleYellowCardsAway
     *
     * @access public
     * @return integer 
     */
    public function getDoubleYellowCardsAway()
    {
        return $this->doubleYellowCardsAway;
    }

    /**
     * Set redCardsHome
     *
     * @access public
     * @param integer $redCardsHome
     * @return Match
     */
    public function setRedCardsHome($redCardsHome = null)
    {
        $this->redCardsHome = $redCardsHome;
        return $this;
    }

    /**
     * Get redCardsHome
     *
     * @access public
     * @return integer 
     */
    public function getRedCardsHome()
    {
        return $this->redCardsHome;
    }

    /**
     * Set redCardsAway
     *
     * @access public
     * @param integer $redCardsAway
     * @return Match
     */
    public function setRedCardsAway($redCardsAway = null)
    {
        $this->redCardsAway = $redCardsAway;
        return $this;
    }

    /**
     * Get redCardsAway
     *
     * @access public
     * @return integer 
     */
    public function getRedCardsAway()
    {
        return $this->redCardsAway;
    }

    /**
     * Set recoveredBallsHome
     *
     * @access public
     * @param integer $recoveredBallsHome
     * @return Match
     */
    public function setRecoveredBallsHome($recoveredBallsHome = null)
    {
        $this->recoveredBallsHome = $recoveredBallsHome;
        return $this;
    }

    /**
     * Get recoveredBallsHome
     *
     * @access public
     * @return integer 
     */
    public function getRecoveredBallsHome()
    {
        return $this->recoveredBallsHome;
    }

    /**
     * Set recoveredBallsAway
     *
     * @access public
     * @param integer $recoveredBallsAway
     * @return Match
     */
    public function setRecoveredBallsAway($recoveredBallsAway = null)
    {
        $this->recoveredBallsAway = $recoveredBallsAway;
        return $this;
    }

    /**
     * Get recoveredBallsAway
     *
     * @access public
     * @return integer 
     */
    public function getRecoveredBallsAway()
    {
        return $this->recoveredBallsAway;
    }

    /**
     * Set turnoversHome
     *
     * @access public
     * @param integer $turnoversHome
     * @return Match
     */
    public function setTurnoversHome($turnoversHome = null)
    {
        $this->turnoversHome = $turnoversHome;
        return $this;
    }

    /**
     * Get turnoversHome
     *
     * @access public
     * @return integer 
     */
    public function getTurnoversHome()
    {
        return $this->turnoversHome;
    }

    /**
     * Set turnoversAway
     *
     * @access public
     * @param integer $turnoversAway
     * @return Match
     */
    public function setTurnoversAway($turnoversAway = null)
    {
        $this->turnoversAway = $turnoversAway;
        return $this;
    }

    /**
     * Get turnoversAway
     *
     * @access public
     * @return integer 
     */
    public function getTurnoversAway()
    {
        return $this->turnoversAway;
    }

    /**
     * Set previous
     *
     * @access public
     * @param string $previous
     * @return Match
     */
    public function setPrevious($previous = null)
    {
        $this->previous = $previous;
        return $this;
    }

    /**
     * Get previous
     *
     * @access public
     * @return string 
     */
    public function getPrevious()
    {
        return $this->previous;
    }

    /**
     * Set previousAr
     *
     * @access public
     * @param string $previousAr
     * @return Match
     */
    public function setPreviousAr($previousAr = null)
    {
        $this->previousAr = $previousAr;
        return $this;
    }

    /**
     * Get previousAr
     *
     * @access public
     * @return string 
     */
    public function getPreviousAr()
    {
        return $this->previousAr;
    }

    /**
     * Set previousFr
     *
     * @access public
     * @param string $previousFr
     * @return Match
     */
    public function setPreviousFr($previousFr = null)
    {
        $this->previousFr = $previousFr;
        return $this;
    }

    /**
     * Get previousFr
     *
     * @access public
     * @return string 
     */
    public function getPreviousFr()
    {
        return $this->previousFr;
    }

    /**
     * Set report
     *
     * @access public
     * @param string $report
     * @return Match
     */
    public function setReport($report = null)
    {
        $this->report = $report;
        return $this;
    }

    /**
     * Get report
     *
     * @access public
     * @return string 
     */
    public function getReport()
    {
        return $this->report;
    }

    /**
     * Set reportAr
     *
     * @access public
     * @param string $reportAr
     * @return Match
     */
    public function setReportAr($reportAr = null)
    {
        $this->reportAr = $reportAr;
        return $this;
    }

    /**
     * Get reportAr
     *
     * @access public
     * @return string 
     */
    public function getReportAr()
    {
        return $this->reportAr;
    }

    /**
     * Set reportFr
     *
     * @access public
     * @param string $reportFr
     * @return Match
     */
    public function setReportFr($reportFr = null)
    {
        $this->reportFr = $reportFr;
        return $this;
    }

    /**
     * Get reportFr
     *
     * @access public
     * @return string 
     */
    public function getReportFr()
    {
        return $this->reportFr;
    }

    /**
     * Set status
     *
     * @access public
     * @param string $status
     * @return Match
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get status
     *
     * @access public
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set isHeadline
     *
     * @access public
     * @param boolean $isHeadline
     * @return Match
     */
    public function setIsHeadline($isHeadline)
    {
        $this->isHeadline = $isHeadline;
        return $this;
    }

    /**
     * Get isHeadline
     *
     * @access public
     * @return boolean 
     */
    public function getIsHeadline()
    {
        return $this->isHeadline;
    }

    /**
     * Set live
     *
     * @access public
     * @param boolean $live
     * @return Match
     */
    public function setLive($live)
    {
        $this->live = $live;
        return $this;
    }

    /**
     * Get live
     *
     * @access public
     * @return boolean 
     */
    public function getLive()
    {
        return $this->live;
    }

    /**
     * Set lastMinute
     *
     * @access public
     * @param string $lastMinute
     * @return Match
     */
    public function setLastMinute($lastMinute = null)
    {
        $this->lastMinute = $lastMinute;
        return $this;
    }

    /**
     * Get lastMinute
     *
     * @access public
     * @return string 
     */
    public function getLastMinute()
    {
        return $this->lastMinute;
    }

    /**
     * Set ticketingLink
     *
     * @access public
     * @param string $ticketingLink
     * @return Match
     */
    public function setTicketingLink($ticketingLink = null)
    {
        $this->ticketingLink = $ticketingLink;
        return $this;
    }

    /**
     * Get ticketingLink
     *
     * @access public
     * @return string 
     */
    public function getTicketingLink()
    {
        return $this->ticketingLink;
    }

    /**
     * Set liveStream
     *
     * @access public
     * @param string $liveStream
     * @return Match
     */
    public function setLiveStream($liveStream = null)
    {
        $this->liveStream = $liveStream;
        return $this;
    }

    /**
     * Get liveStream
     *
     * @access public
     * @return string 
     */
    public function getLiveStream()
    {
        return $this->liveStream;
    }

    /**
     * Set createdAt
     *
     * @access public
     * @param \DateTime $createdAt
     * @return Match
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
     * @return Match
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
     * Set gallery
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Gallery $gallery
     * @return Match
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
     * Set show
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Show $show
     * @return Match
     */
    public function setShow(Show $show = null)
    {
        $this->show = $show;
        return $this;
    }

    /**
     * Get show
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Show 
     */
    public function getShow()
    {
        return $this->show;
    }

    /**
     * Set day
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Day $day
     * @return Match
     */
    public function setDay(Day $day = null)
    {
        $this->day = $day;
        return $this;
    }

    /**
     * Get day
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Day 
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set teamHome
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Team $teamHome
     * @return Match
     */
    public function setTeamHome(Team $teamHome = null)
    {
        $this->teamHome = $teamHome;
        return $this;
    }

    /**
     * Get teamHome
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Team 
     */
    public function getTeamHome()
    {
        return $this->teamHome;
    }

    /**
     * Set teamAway
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Team $teamAway
     * @return Match
     */
    public function setTeamAway(Team $teamAway = null)
    {
        $this->teamAway = $teamAway;
        return $this;
    }

    /**
     * Get teamAway
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Team 
     */
    public function getTeamAway()
    {
        return $this->teamAway;
    }

    /**
     * Set country
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Country $country
     * @return Match
     */
    public function setCountry(Country $country = null)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * Get country
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set city
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\City $city
     * @return Match
     */
    public function setCity(City $city = null)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * Get city
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\City 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set stadium
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Stadium $stadium
     * @return Match
     */
    public function setStadium(Stadium $stadium = null)
    {
        $this->stadium = $stadium;
        return $this;
    }

    /**
     * Get stadium
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Stadium 
     */
    public function getStadium()
    {
        return $this->stadium;
    }

    /**
     * Set creatorUser
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\User $creatorUser
     * @return Match
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
     * @return Match
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
