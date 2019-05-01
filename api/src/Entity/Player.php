<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Player
 *
 * @ORM\Table(name="player", indexes={@ORM\Index(name="player_dom_start_id", columns={"dom_start_id"}), @ORM\Index(name="player_tag", columns={"tag"}), @ORM\Index(name="player_race", columns={"race"}), @ORM\Index(name="player_country", columns={"country"}), @ORM\Index(name="player_name_like", columns={"name"}), @ORM\Index(name="player_country_like", columns={"country"}), @ORM\Index(name="player_race_like", columns={"race"}), @ORM\Index(name="player_dom_end_id", columns={"dom_end_id"}), @ORM\Index(name="player_current_rating_id", columns={"current_rating_id"})})
 * @ORM\Entity
 */
class Player
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="player_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="string", length=30, nullable=false)
     */
    private $tag;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="birthday", type="date", nullable=true)
     */
    private $birthday;

    /**
     * @var int|null
     *
     * @ORM\Column(name="mcnum", type="integer", nullable=true)
     */
    private $mcnum;

    /**
     * @var int|null
     *
     * @ORM\Column(name="tlpd_id", type="integer", nullable=true)
     */
    private $tlpdId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="tlpd_db", type="integer", nullable=true)
     */
    private $tlpdDb;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lp_name", type="string", length=200, nullable=true)
     */
    private $lpName;

    /**
     * @var int|null
     *
     * @ORM\Column(name="sc2e_id", type="integer", nullable=true)
     */
    private $sc2eId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="country", type="string", length=2, nullable=true)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="race", type="string", length=1, nullable=false)
     */
    private $race;

    /**
     * @var float|null
     *
     * @ORM\Column(name="dom_val", type="float", precision=10, scale=0, nullable=true)
     */
    private $domVal;

    /**
     * @var string|null
     *
     * @ORM\Column(name="romanized_name", type="string", length=100, nullable=true)
     */
    private $romanizedName;

    /**
     * @var \Rating
     *
     * @ORM\ManyToOne(targetEntity="Rating")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="current_rating_id", referencedColumnName="id")
     * })
     */
    private $currentRating;

    /**
     * @var \Period
     *
     * @ORM\ManyToOne(targetEntity="Period")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="dom_end_id", referencedColumnName="id")
     * })
     */
    private $domEnd;

    /**
     * @var \Period
     *
     * @ORM\ManyToOne(targetEntity="Period")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="dom_start_id", referencedColumnName="id")
     * })
     */
    private $domStart;


}
