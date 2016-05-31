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
 * Impression Entity
 * 
 * Storing Impressions data to the database using Doctrine
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
 * @see        Impression
 * @since      Class available since Release 1.0
 * @access     public
 * 
 * @ORM\Table(name="`impression`", indexes={@ORM\Index(name="visit_id", columns={"visit_id"}), @ORM\Index(name="banner_id", columns={"banner_id"}), @ORM\Index(name="creator_user_id", columns={"creator_user_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ExclusionPolicy("none")
 * 
 */
class Impression 
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
     * @var \ContinuousNet\SportClubBundle\Entity\Visit
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Visit")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="visit_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $visit;

    /**
     * @var \ContinuousNet\SportClubBundle\Entity\Banner
     * @access private
     *
     * @ORM\ManyToOne(targetEntity="Banner")
     * @ORM\JoinColumns({
     *        @ORM\JoinColumn(name="banner_id", referencedColumnName="id")
     * })
     * 
     * @Expose
     * @MaxDepth(1)
     * 
     */
    private $banner;

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
     * Set createdAt
     *
     * @access public
     * @param \DateTime $createdAt
     * @return Impression
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
     * Set visit
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Visit $visit
     * @return Impression
     */
    public function setVisit(Visit $visit = null)
    {
        $this->visit = $visit;
        return $this;
    }

    /**
     * Get visit
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Visit 
     */
    public function getVisit()
    {
        return $this->visit;
    }

    /**
     * Set banner
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\Banner $banner
     * @return Impression
     */
    public function setBanner(Banner $banner = null)
    {
        $this->banner = $banner;
        return $this;
    }

    /**
     * Get banner
     *
     * @access public
     * @return \ContinuousNet\SportClubBundle\Entity\Banner 
     */
    public function getBanner()
    {
        return $this->banner;
    }

    /**
     * Set creatorUser
     *
     * @access public
     * @param \ContinuousNet\SportClubBundle\Entity\User $creatorUser
     * @return Impression
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
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
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
