<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * Earnings
 *
 * @ORM\Table(name="earnings")
 * @ORM\Entity
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
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
     * @MaxDepth(1)
     */
    private $event;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEarnings(): ?int
    {
        return $this->earnings;
    }

    public function setEarnings(?int $earnings): self
    {
        $this->earnings = $earnings;

        return $this;
    }

    public function getOrigearnings()
    {
        return $this->origearnings;
    }

    public function setOrigearnings($origearnings): self
    {
        $this->origearnings = $origearnings;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getPlacement(): ?int
    {
        return $this->placement;
    }

    public function setPlacement(int $placement): self
    {
        $this->placement = $placement;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

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


}
