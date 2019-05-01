<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * Groupmembership
 *
 * @ORM\Table(name="groupmembership", indexes={@ORM\Index(name="groupmembership_player_id", columns={"player_id"}), @ORM\Index(name="groupmembership_current", columns={"current"}), @ORM\Index(name="groupmembership_group_id", columns={"group_id"}), @ORM\Index(name="groupmembership_playing", columns={"playing"})})
 * @ORM\Entity
 */
class Groupmembership
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="groupmembership_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="start", type="date", nullable=true)
     */
    private $start;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="end", type="date", nullable=true)
     */
    private $end;

    /**
     * @var bool
     *
     * @ORM\Column(name="current", type="boolean", nullable=false)
     */
    private $current;

    /**
     * @var bool
     *
     * @ORM\Column(name="playing", type="boolean", nullable=false)
     */
    private $playing;

    /**
     * @var \Group
     *
     * @ORM\ManyToOne(targetEntity="Group")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     * })
     * @MaxDepth(1)
     */
    private $group;

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

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(?\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(?\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getCurrent(): ?bool
    {
        return $this->current;
    }

    public function setCurrent(bool $current): self
    {
        $this->current = $current;

        return $this;
    }

    public function getPlaying(): ?bool
    {
        return $this->playing;
    }

    public function setPlaying(bool $playing): self
    {
        $this->playing = $playing;

        return $this;
    }

    public function getGroup(): ?Group
    {
        return $this->group;
    }

    public function setGroup(?Group $group): self
    {
        $this->group = $group;

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
