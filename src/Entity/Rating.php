<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * Rating
 *
 * @ORM\Table(name="rating", indexes={@ORM\Index(name="rating_prev_id", columns={"prev_id"}), @ORM\Index(name="rating_player_id", columns={"player_id"}), @ORM\Index(name="rating_period_id", columns={"period_id"})})
 * @ORM\Entity
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
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
     * @MaxDepth(1)
     */
    private $period;

    /**
     * @var \Player
     *
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     * })
     * @MaxDepth(1)
     */
    private $player;

    /**
     * @var \Rating
     *
     * @ORM\ManyToOne(targetEntity="Rating")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="prev_id", referencedColumnName="id")
     * })
     * @MaxDepth(1)
     */
    private $prev;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(float $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getRatingVp(): ?float
    {
        return $this->ratingVp;
    }

    public function setRatingVp(float $ratingVp): self
    {
        $this->ratingVp = $ratingVp;

        return $this;
    }

    public function getRatingVt(): ?float
    {
        return $this->ratingVt;
    }

    public function setRatingVt(float $ratingVt): self
    {
        $this->ratingVt = $ratingVt;

        return $this;
    }

    public function getRatingVz(): ?float
    {
        return $this->ratingVz;
    }

    public function setRatingVz(float $ratingVz): self
    {
        $this->ratingVz = $ratingVz;

        return $this;
    }

    public function getDev(): ?float
    {
        return $this->dev;
    }

    public function setDev(float $dev): self
    {
        $this->dev = $dev;

        return $this;
    }

    public function getDevVp(): ?float
    {
        return $this->devVp;
    }

    public function setDevVp(float $devVp): self
    {
        $this->devVp = $devVp;

        return $this;
    }

    public function getDevVt(): ?float
    {
        return $this->devVt;
    }

    public function setDevVt(float $devVt): self
    {
        $this->devVt = $devVt;

        return $this;
    }

    public function getDevVz(): ?float
    {
        return $this->devVz;
    }

    public function setDevVz(float $devVz): self
    {
        $this->devVz = $devVz;

        return $this;
    }

    public function getCompRat(): ?float
    {
        return $this->compRat;
    }

    public function setCompRat(?float $compRat): self
    {
        $this->compRat = $compRat;

        return $this;
    }

    public function getCompRatVp(): ?float
    {
        return $this->compRatVp;
    }

    public function setCompRatVp(?float $compRatVp): self
    {
        $this->compRatVp = $compRatVp;

        return $this;
    }

    public function getCompRatVt(): ?float
    {
        return $this->compRatVt;
    }

    public function setCompRatVt(?float $compRatVt): self
    {
        $this->compRatVt = $compRatVt;

        return $this;
    }

    public function getCompRatVz(): ?float
    {
        return $this->compRatVz;
    }

    public function setCompRatVz(?float $compRatVz): self
    {
        $this->compRatVz = $compRatVz;

        return $this;
    }

    public function getBfRating(): ?float
    {
        return $this->bfRating;
    }

    public function setBfRating(float $bfRating): self
    {
        $this->bfRating = $bfRating;

        return $this;
    }

    public function getBfRatingVp(): ?float
    {
        return $this->bfRatingVp;
    }

    public function setBfRatingVp(float $bfRatingVp): self
    {
        $this->bfRatingVp = $bfRatingVp;

        return $this;
    }

    public function getBfRatingVt(): ?float
    {
        return $this->bfRatingVt;
    }

    public function setBfRatingVt(float $bfRatingVt): self
    {
        $this->bfRatingVt = $bfRatingVt;

        return $this;
    }

    public function getBfRatingVz(): ?float
    {
        return $this->bfRatingVz;
    }

    public function setBfRatingVz(float $bfRatingVz): self
    {
        $this->bfRatingVz = $bfRatingVz;

        return $this;
    }

    public function getBfDev(): ?float
    {
        return $this->bfDev;
    }

    public function setBfDev(?float $bfDev): self
    {
        $this->bfDev = $bfDev;

        return $this;
    }

    public function getBfDevVp(): ?float
    {
        return $this->bfDevVp;
    }

    public function setBfDevVp(?float $bfDevVp): self
    {
        $this->bfDevVp = $bfDevVp;

        return $this;
    }

    public function getBfDevVt(): ?float
    {
        return $this->bfDevVt;
    }

    public function setBfDevVt(?float $bfDevVt): self
    {
        $this->bfDevVt = $bfDevVt;

        return $this;
    }

    public function getBfDevVz(): ?float
    {
        return $this->bfDevVz;
    }

    public function setBfDevVz(?float $bfDevVz): self
    {
        $this->bfDevVz = $bfDevVz;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getPositionVp(): ?int
    {
        return $this->positionVp;
    }

    public function setPositionVp(?int $positionVp): self
    {
        $this->positionVp = $positionVp;

        return $this;
    }

    public function getPositionVt(): ?int
    {
        return $this->positionVt;
    }

    public function setPositionVt(?int $positionVt): self
    {
        $this->positionVt = $positionVt;

        return $this;
    }

    public function getPositionVz(): ?int
    {
        return $this->positionVz;
    }

    public function setPositionVz(?int $positionVz): self
    {
        $this->positionVz = $positionVz;

        return $this;
    }

    public function getDecay(): ?int
    {
        return $this->decay;
    }

    public function setDecay(int $decay): self
    {
        $this->decay = $decay;

        return $this;
    }

    public function getDomination(): ?float
    {
        return $this->domination;
    }

    public function setDomination(?float $domination): self
    {
        $this->domination = $domination;

        return $this;
    }

    public function getPeriod(): ?Period
    {
        return $this->period;
    }

    public function setPeriod(?Period $period): self
    {
        $this->period = $period;

        return $this;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getPrev(): ?self
    {
        return $this->prev;
    }

    public function setPrev(?self $prev): self
    {
        $this->prev = $prev;

        return $this;
    }


}
