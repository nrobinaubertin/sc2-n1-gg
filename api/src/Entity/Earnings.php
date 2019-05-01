<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Earnings
 *
 * @ORM\Table(name="earnings", indexes={@ORM\Index(name="earnings_event_id", columns={"event_id"}), @ORM\Index(name="earnings_player_id", columns={"player_id"})})
 * @ORM\Entity
 */
class Earnings
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="earnings_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="earnings", type="integer", nullable=true)
     */
    private $earnings;

    /**
     * @var string
     *
     * @ORM\Column(name="origearnings", type="decimal", precision=20, scale=8, nullable=false)
     */
    private $origearnings;

    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string", length=30, nullable=false)
     */
    private $currency;

    /**
     * @var int
     *
     * @ORM\Column(name="placement", type="integer", nullable=false)
     */
    private $placement;

    /**
     * @var \Event
     *
     * @ORM\ManyToOne(targetEntity="Event")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     * })
     */
    private $event;

    /**
     * @var \Player
     *
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     * })
     */
    private $player;


}
