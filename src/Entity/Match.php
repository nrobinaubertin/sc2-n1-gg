<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * Match
 *
 * @ORM\Table(name="match")
 * @ORM\Entity
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
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
     * @MaxDepth(1)
     */
    private $eventobj;

    /**
     * @var \Player
     *
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pla_id", referencedColumnName="id")
     * })
     * @MaxDepth(1)
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getSca(): ?int
    {
        return $this->sca;
    }

    public function setSca(int $sca): self
    {
        $this->sca = $sca;

        return $this;
    }

    public function getScb(): ?int
    {
        return $this->scb;
    }

    public function setScb(int $scb): self
    {
        $this->scb = $scb;

        return $this;
    }

    public function getRca(): ?string
    {
        return $this->rca;
    }

    public function setRca(string $rca): self
    {
        $this->rca = $rca;

        return $this;
    }

    public function getRcb(): ?string
    {
        return $this->rcb;
    }

    public function setRcb(string $rcb): self
    {
        $this->rcb = $rcb;

        return $this;
    }

    public function getTreated(): ?bool
    {
        return $this->treated;
    }

    public function setTreated(bool $treated): self
    {
        $this->treated = $treated;

        return $this;
    }

    public function getEvent(): ?string
    {
        return $this->event;
    }

    public function setEvent(string $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getSubmitterId(): ?int
    {
        return $this->submitterId;
    }

    public function setSubmitterId(?int $submitterId): self
    {
        $this->submitterId = $submitterId;

        return $this;
    }

    public function getGame(): ?string
    {
        return $this->game;
    }

    public function setGame(string $game): self
    {
        $this->game = $game;

        return $this;
    }

    public function getOffline(): ?bool
    {
        return $this->offline;
    }

    public function setOffline(bool $offline): self
    {
        $this->offline = $offline;

        return $this;
    }

    public function getEventobj(): ?Event
    {
        return $this->eventobj;
    }

    public function setEventobj(?Event $eventobj): self
    {
        $this->eventobj = $eventobj;

        return $this;
    }

    public function getPla(): ?Player
    {
        return $this->pla;
    }

    public function setPla(?Player $pla): self
    {
        $this->pla = $pla;

        return $this;
    }

    public function getPlb(): ?Player
    {
        return $this->plb;
    }

    public function setPlb(?Player $plb): self
    {
        $this->plb = $plb;

        return $this;
    }
}
