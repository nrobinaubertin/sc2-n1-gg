<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * Team
 *
 * @ORM\Table(name="team", indexes={@ORM\Index(name="group_name_like", columns={"name"}), @ORM\Index(name="group_is_team", columns={"is_team"}), @ORM\Index(name="group_name", columns={"name"}), @ORM\Index(name="group_active", columns={"active"})})
 * @ORM\Entity
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 */
class Team
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="group_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="shortname", type="string", length=25, nullable=true)
     */
    private $shortname;

    /**
     * @var float|null
     *
     * @ORM\Column(name="scoreak", type="float", precision=10, scale=0, nullable=true)
     */
    private $scoreak;

    /**
     * @var float|null
     *
     * @ORM\Column(name="scorepl", type="float", precision=10, scale=0, nullable=true)
     */
    private $scorepl;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="founded", type="date", nullable=true)
     */
    private $founded;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="disbanded", type="date", nullable=true)
     */
    private $disbanded;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active;

    /**
     * @var string|null
     *
     * @ORM\Column(name="homepage", type="string", length=200, nullable=true)
     */
    private $homepage;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lp_name", type="string", length=200, nullable=true)
     */
    private $lpName;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_team", type="boolean", nullable=false)
     */
    private $isTeam;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_manual", type="boolean", nullable=false)
     */
    private $isManual;

    /**
     * @var float|null
     *
     * @ORM\Column(name="meanrating", type="float", precision=10, scale=0, nullable=true)
     */
    private $meanrating;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getShortname(): ?string
    {
        return $this->shortname;
    }

    public function setShortname(?string $shortname): self
    {
        $this->shortname = $shortname;

        return $this;
    }

    public function getScoreak(): ?float
    {
        return $this->scoreak;
    }

    public function setScoreak(?float $scoreak): self
    {
        $this->scoreak = $scoreak;

        return $this;
    }

    public function getScorepl(): ?float
    {
        return $this->scorepl;
    }

    public function setScorepl(?float $scorepl): self
    {
        $this->scorepl = $scorepl;

        return $this;
    }

    public function getFounded(): ?\DateTimeInterface
    {
        return $this->founded;
    }

    public function setFounded(?\DateTimeInterface $founded): self
    {
        $this->founded = $founded;

        return $this;
    }

    public function getDisbanded(): ?\DateTimeInterface
    {
        return $this->disbanded;
    }

    public function setDisbanded(?\DateTimeInterface $disbanded): self
    {
        $this->disbanded = $disbanded;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getHomepage(): ?string
    {
        return $this->homepage;
    }

    public function setHomepage(?string $homepage): self
    {
        $this->homepage = $homepage;

        return $this;
    }

    public function getLpName(): ?string
    {
        return $this->lpName;
    }

    public function setLpName(?string $lpName): self
    {
        $this->lpName = $lpName;

        return $this;
    }

    public function getIsTeam(): ?bool
    {
        return $this->isTeam;
    }

    public function setIsTeam(bool $isTeam): self
    {
        $this->isTeam = $isTeam;

        return $this;
    }

    public function getIsManual(): ?bool
    {
        return $this->isManual;
    }

    public function setIsManual(bool $isManual): self
    {
        $this->isManual = $isManual;

        return $this;
    }

    public function getMeanrating(): ?float
    {
        return $this->meanrating;
    }

    public function setMeanrating(?float $meanrating): self
    {
        $this->meanrating = $meanrating;

        return $this;
    }


}
