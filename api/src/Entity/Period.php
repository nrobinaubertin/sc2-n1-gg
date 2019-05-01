<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * Period
 *
 * @ORM\Table(name="period", indexes={@ORM\Index(name="period_start", columns={"start"}), @ORM\Index(name="period_needs_recompute", columns={"needs_recompute"}), @ORM\Index(name="period_computed", columns={"computed"}), @ORM\Index(name="period_end", columns={"end"})})
 * @ORM\Entity
 */
class Period
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="period_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start", type="date", nullable=false)
     */
    private $start;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end", type="date", nullable=false)
     */
    private $end;

    /**
     * @var bool
     *
     * @ORM\Column(name="computed", type="boolean", nullable=false)
     */
    private $computed;

    /**
     * @var bool
     *
     * @ORM\Column(name="needs_recompute", type="boolean", nullable=false)
     */
    private $needsRecompute;

    /**
     * @var int
     *
     * @ORM\Column(name="num_retplayers", type="integer", nullable=false)
     */
    private $numRetplayers;

    /**
     * @var int
     *
     * @ORM\Column(name="num_newplayers", type="integer", nullable=false)
     */
    private $numNewplayers;

    /**
     * @var int
     *
     * @ORM\Column(name="num_games", type="integer", nullable=false)
     */
    private $numGames;

    /**
     * @var float|null
     *
     * @ORM\Column(name="dom_p", type="float", precision=10, scale=0, nullable=true)
     */
    private $domP;

    /**
     * @var float|null
     *
     * @ORM\Column(name="dom_t", type="float", precision=10, scale=0, nullable=true)
     */
    private $domT;

    /**
     * @var float|null
     *
     * @ORM\Column(name="dom_z", type="float", precision=10, scale=0, nullable=true)
     */
    private $domZ;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getComputed(): ?bool
    {
        return $this->computed;
    }

    public function setComputed(bool $computed): self
    {
        $this->computed = $computed;

        return $this;
    }

    public function getNeedsRecompute(): ?bool
    {
        return $this->needsRecompute;
    }

    public function setNeedsRecompute(bool $needsRecompute): self
    {
        $this->needsRecompute = $needsRecompute;

        return $this;
    }

    public function getNumRetplayers(): ?int
    {
        return $this->numRetplayers;
    }

    public function setNumRetplayers(int $numRetplayers): self
    {
        $this->numRetplayers = $numRetplayers;

        return $this;
    }

    public function getNumNewplayers(): ?int
    {
        return $this->numNewplayers;
    }

    public function setNumNewplayers(int $numNewplayers): self
    {
        $this->numNewplayers = $numNewplayers;

        return $this;
    }

    public function getNumGames(): ?int
    {
        return $this->numGames;
    }

    public function setNumGames(int $numGames): self
    {
        $this->numGames = $numGames;

        return $this;
    }

    public function getDomP(): ?float
    {
        return $this->domP;
    }

    public function setDomP(?float $domP): self
    {
        $this->domP = $domP;

        return $this;
    }

    public function getDomT(): ?float
    {
        return $this->domT;
    }

    public function setDomT(?float $domT): self
    {
        $this->domT = $domT;

        return $this;
    }

    public function getDomZ(): ?float
    {
        return $this->domZ;
    }

    public function setDomZ(?float $domZ): self
    {
        $this->domZ = $domZ;

        return $this;
    }


}
