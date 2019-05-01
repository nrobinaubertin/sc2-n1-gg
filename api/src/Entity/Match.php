<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Match
 *
 * @ORM\Table(name="match", indexes={@ORM\Index(name="match_rcb_like", columns={"rcb"}), @ORM\Index(name="match_rca", columns={"rca"}), @ORM\Index(name="match_eventobj_id", columns={"eventobj_id"}), @ORM\Index(name="match_submitter_id", columns={"submitter_id"}), @ORM\Index(name="match_scb", columns={"scb"}), @ORM\Index(name="match_rta_id", columns={"rta_id"}), @ORM\Index(name="match_rtb_id", columns={"rtb_id"}), @ORM\Index(name="match_offline", columns={"offline"}), @ORM\Index(name="match_plb_id", columns={"plb_id"}), @ORM\Index(name="match_pla_id", columns={"pla_id"}), @ORM\Index(name="match_game", columns={"game"}), @ORM\Index(name="match_game_like", columns={"game"}), @ORM\Index(name="match_rcb", columns={"rcb"}), @ORM\Index(name="match_sca", columns={"sca"}), @ORM\Index(name="match_rca_like", columns={"rca"}), @ORM\Index(name="match_period_id", columns={"period_id"})})
 * @ORM\Entity
 */
class Match
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="match_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="sca", type="smallint", nullable=false)
     */
    private $sca;

    /**
     * @var int
     *
     * @ORM\Column(name="scb", type="smallint", nullable=false)
     */
    private $scb;

    /**
     * @var string
     *
     * @ORM\Column(name="rca", type="string", length=1, nullable=false)
     */
    private $rca;

    /**
     * @var string
     *
     * @ORM\Column(name="rcb", type="string", length=1, nullable=false)
     */
    private $rcb;

    /**
     * @var bool
     *
     * @ORM\Column(name="treated", type="boolean", nullable=false)
     */
    private $treated;

    /**
     * @var string
     *
     * @ORM\Column(name="event", type="string", length=200, nullable=false)
     */
    private $event;

    /**
     * @var int|null
     *
     * @ORM\Column(name="submitter_id", type="integer", nullable=true)
     */
    private $submitterId;

    /**
     * @var string
     *
     * @ORM\Column(name="game", type="string", length=10, nullable=false)
     */
    private $game;

    /**
     * @var bool
     *
     * @ORM\Column(name="offline", type="boolean", nullable=false)
     */
    private $offline;

    /**
     * @var \Event
     *
     * @ORM\ManyToOne(targetEntity="Event")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="eventobj_id", referencedColumnName="id")
     * })
     */
    private $eventobj;

    /**
     * @var \Period
     *
     * @ORM\ManyToOne(targetEntity="Period")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="period_id", referencedColumnName="id")
     * })
     */
    private $period;

    /**
     * @var \Player
     *
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pla_id", referencedColumnName="id")
     * })
     */
    private $pla;

    /**
     * @var \Player
     *
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="plb_id", referencedColumnName="id")
     * })
     */
    private $plb;

    /**
     * @var \Rating
     *
     * @ORM\ManyToOne(targetEntity="Rating")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rta_id", referencedColumnName="id")
     * })
     */
    private $rta;

    /**
     * @var \Rating
     *
     * @ORM\ManyToOne(targetEntity="Rating")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rtb_id", referencedColumnName="id")
     * })
     */
    private $rtb;


}
