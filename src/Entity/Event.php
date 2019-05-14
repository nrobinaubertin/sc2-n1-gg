<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 */
class Event
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="event_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="closed", type="boolean", nullable=false)
     */
    private $closed;

    /**
     * @var bool
     *
     * @ORM\Column(name="big", type="boolean", nullable=false)
     */
    private $big;

    /**
     * @var string
     *
     * @ORM\Column(name="fullname", type="string", length=500, nullable=false)
     */
    private $fullname;

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
     * @var bool|null
     *
     * @ORM\Column(name="prizepool", type="boolean", nullable=true)
     */
    private $prizepool;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="earliest", type="date", nullable=true)
     */
    private $earliest;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="latest", type="date", nullable=true)
     */
    private $latest;

    /**
     * @var string|null
     *
     * @ORM\Column(name="category", type="string", length=50, nullable=true)
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50, nullable=false)
     */
    private $type;

    /**
     * @var \Event
     *
     * @ORM\ManyToOne(targetEntity="Event")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * })
     * @MaxDepth(1)
     */
    private $parent;

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

    public function getClosed(): ?bool
    {
        return $this->closed;
    }

    public function setClosed(bool $closed): self
    {
        $this->closed = $closed;

        return $this;
    }

    public function getBig(): ?bool
    {
        return $this->big;
    }

    public function setBig(bool $big): self
    {
        $this->big = $big;

        return $this;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(string $fullname): self
    {
        $this->fullname = $fullname;

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

    public function getPrizepool(): ?bool
    {
        return $this->prizepool;
    }

    public function setPrizepool(?bool $prizepool): self
    {
        $this->prizepool = $prizepool;

        return $this;
    }

    public function getEarliest(): ?\DateTimeInterface
    {
        return $this->earliest;
    }

    public function setEarliest(?\DateTimeInterface $earliest): self
    {
        $this->earliest = $earliest;

        return $this;
    }

    public function getLatest(): ?\DateTimeInterface
    {
        return $this->latest;
    }

    public function setLatest(?\DateTimeInterface $latest): self
    {
        $this->latest = $latest;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }
}
