<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rating
 *
 * @ORM\Table(name="rating", indexes={@ORM\Index(name="rating_prev_id", columns={"prev_id"}), @ORM\Index(name="rating_player_id", columns={"player_id"}), @ORM\Index(name="rating_period_id", columns={"period_id"})})
 * @ORM\Entity
 */
class Rating
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="rating_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="rating", type="float", precision=10, scale=0, nullable=false)
     */
    private $rating;

    /**
     * @var float
     *
     * @ORM\Column(name="rating_vp", type="float", precision=10, scale=0, nullable=false)
     */
    private $ratingVp;

    /**
     * @var float
     *
     * @ORM\Column(name="rating_vt", type="float", precision=10, scale=0, nullable=false)
     */
    private $ratingVt;

    /**
     * @var float
     *
     * @ORM\Column(name="rating_vz", type="float", precision=10, scale=0, nullable=false)
     */
    private $ratingVz;

    /**
     * @var float
     *
     * @ORM\Column(name="dev", type="float", precision=10, scale=0, nullable=false)
     */
    private $dev;

    /**
     * @var float
     *
     * @ORM\Column(name="dev_vp", type="float", precision=10, scale=0, nullable=false)
     */
    private $devVp;

    /**
     * @var float
     *
     * @ORM\Column(name="dev_vt", type="float", precision=10, scale=0, nullable=false)
     */
    private $devVt;

    /**
     * @var float
     *
     * @ORM\Column(name="dev_vz", type="float", precision=10, scale=0, nullable=false)
     */
    private $devVz;

    /**
     * @var float|null
     *
     * @ORM\Column(name="comp_rat", type="float", precision=10, scale=0, nullable=true)
     */
    private $compRat;

    /**
     * @var float|null
     *
     * @ORM\Column(name="comp_rat_vp", type="float", precision=10, scale=0, nullable=true)
     */
    private $compRatVp;

    /**
     * @var float|null
     *
     * @ORM\Column(name="comp_rat_vt", type="float", precision=10, scale=0, nullable=true)
     */
    private $compRatVt;

    /**
     * @var float|null
     *
     * @ORM\Column(name="comp_rat_vz", type="float", precision=10, scale=0, nullable=true)
     */
    private $compRatVz;

    /**
     * @var float
     *
     * @ORM\Column(name="bf_rating", type="float", precision=10, scale=0, nullable=false)
     */
    private $bfRating;

    /**
     * @var float
     *
     * @ORM\Column(name="bf_rating_vp", type="float", precision=10, scale=0, nullable=false)
     */
    private $bfRatingVp;

    /**
     * @var float
     *
     * @ORM\Column(name="bf_rating_vt", type="float", precision=10, scale=0, nullable=false)
     */
    private $bfRatingVt;

    /**
     * @var float
     *
     * @ORM\Column(name="bf_rating_vz", type="float", precision=10, scale=0, nullable=false)
     */
    private $bfRatingVz;

    /**
     * @var float|null
     *
     * @ORM\Column(name="bf_dev", type="float", precision=10, scale=0, nullable=true)
     */
    private $bfDev;

    /**
     * @var float|null
     *
     * @ORM\Column(name="bf_dev_vp", type="float", precision=10, scale=0, nullable=true)
     */
    private $bfDevVp;

    /**
     * @var float|null
     *
     * @ORM\Column(name="bf_dev_vt", type="float", precision=10, scale=0, nullable=true)
     */
    private $bfDevVt;

    /**
     * @var float|null
     *
     * @ORM\Column(name="bf_dev_vz", type="float", precision=10, scale=0, nullable=true)
     */
    private $bfDevVz;

    /**
     * @var int|null
     *
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    private $position;

    /**
     * @var int|null
     *
     * @ORM\Column(name="position_vp", type="integer", nullable=true)
     */
    private $positionVp;

    /**
     * @var int|null
     *
     * @ORM\Column(name="position_vt", type="integer", nullable=true)
     */
    private $positionVt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="position_vz", type="integer", nullable=true)
     */
    private $positionVz;

    /**
     * @var int
     *
     * @ORM\Column(name="decay", type="integer", nullable=false)
     */
    private $decay;

    /**
     * @var float|null
     *
     * @ORM\Column(name="domination", type="float", precision=10, scale=0, nullable=true)
     */
    private $domination;

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
     *   @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     * })
     */
    private $player;

    /**
     * @var \Rating
     *
     * @ORM\ManyToOne(targetEntity="Rating")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="prev_id", referencedColumnName="id")
     * })
     */
    private $prev;


}
