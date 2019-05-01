<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * Event
 *
 * @ORM\Table(name="event", indexes={@ORM\Index(name="event_type", columns={"type"}), @ORM\Index(name="event_latest", columns={"latest"}), @ORM\Index(name="event_idx", columns={"idx"}), @ORM\Index(name="event_closed", columns={"closed"}), @ORM\Index(name="event_prizepool", columns={"prizepool"}), @ORM\Index(name="event_parent_id", columns={"parent_id"}), @ORM\Index(name="event_earliest", columns={"earliest"}), @ORM\Index(name="event_category", columns={"category"}), @ORM\Index(name="event_noprint", columns={"noprint"})})
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
     * @var int|null
     *
     * @ORM\Column(name="lft", type="integer", nullable=true)
     */
    private $lft;

    /**
     * @var int|null
     *
     * @ORM\Column(name="rgt", type="integer", nullable=true)
     */
    private $rgt;

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
     * @var bool
     *
     * @ORM\Column(name="noprint", type="boolean", nullable=false)
     */
    private $noprint;

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
     * @var int|null
     *
     * @ORM\Column(name="tl_thread", type="integer", nullable=true)
     */
    private $tlThread;

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
     * @var int
     *
     * @ORM\Column(name="idx", type="integer", nullable=false)
     */
    private $idx;

    /**
     * @var int|null
     *
     * @ORM\Column(name="wcs_year", type="integer", nullable=true)
     */
    private $wcsYear;

    /**
     * @var int|null
     *
     * @ORM\Column(name="wcs_tier", type="integer", nullable=true)
     */
    private $wcsTier;

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

    public function getLft(): ?int
    {
        return $this->lft;
    }

    public function setLft(?int $lft): self
    {
        $this->lft = $lft;

        return $this;
    }

    public function getRgt(): ?int
    {
        return $this->rgt;
    }

    public function setRgt(?int $rgt): self
    {
        $this->rgt = $rgt;

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

    public function getNoprint(): ?bool
    {
        return $this->noprint;
    }

    public function setNoprint(bool $noprint): self
    {
        $this->noprint = $noprint;

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

    public function getTlpdId(): ?int
    {
        return $this->tlpdId;
    }

    public function setTlpdId(?int $tlpdId): self
    {
        $this->tlpdId = $tlpdId;

        return $this;
    }

    public function getTlpdDb(): ?int
    {
        return $this->tlpdDb;
    }

    public function setTlpdDb(?int $tlpdDb): self
    {
        $this->tlpdDb = $tlpdDb;

        return $this;
    }

    public function getTlThread(): ?int
    {
        return $this->tlThread;
    }

    public function setTlThread(?int $tlThread): self
    {
        $this->tlThread = $tlThread;

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

    public function getIdx(): ?int
    {
        return $this->idx;
    }

    public function setIdx(int $idx): self
    {
        $this->idx = $idx;

        return $this;
    }

    public function getWcsYear(): ?int
    {
        return $this->wcsYear;
    }

    public function setWcsYear(?int $wcsYear): self
    {
        $this->wcsYear = $wcsYear;

        return $this;
    }

    public function getWcsTier(): ?int
    {
        return $this->wcsTier;
    }

    public function setWcsTier(?int $wcsTier): self
    {
        $this->wcsTier = $wcsTier;

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
