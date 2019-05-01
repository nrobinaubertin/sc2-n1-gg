<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * Player
 *
 * @ORM\Table(name="player", indexes={@ORM\Index(name="player_dom_start_id", columns={"dom_start_id"}), @ORM\Index(name="player_tag", columns={"tag"}), @ORM\Index(name="player_race", columns={"race"}), @ORM\Index(name="player_country", columns={"country"}), @ORM\Index(name="player_name_like", columns={"name"}), @ORM\Index(name="player_country_like", columns={"country"}), @ORM\Index(name="player_race_like", columns={"race"}), @ORM\Index(name="player_dom_end_id", columns={"dom_end_id"}), @ORM\Index(name="player_current_rating_id", columns={"current_rating_id"})})
 * @ORM\Entity
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
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
     * @MaxDepth(1)
     */
    private $currentRating;

    /**
     * @var \Period
     *
     * @ORM\ManyToOne(targetEntity="Period")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="dom_end_id", referencedColumnName="id")
     * })
     * @MaxDepth(1)
     */
    private $domEnd;

    /**
     * @var \Period
     *
     * @ORM\ManyToOne(targetEntity="Period")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="dom_start_id", referencedColumnName="id")
     * })
     * @MaxDepth(1)
     */
    private $domStart;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTag(string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(?\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getMcnum(): ?int
    {
        return $this->mcnum;
    }

    public function setMcnum(?int $mcnum): self
    {
        $this->mcnum = $mcnum;

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

    public function getLpName(): ?string
    {
        return $this->lpName;
    }

    public function setLpName(?string $lpName): self
    {
        $this->lpName = $lpName;

        return $this;
    }

    public function getSc2eId(): ?int
    {
        return $this->sc2eId;
    }

    public function setSc2eId(?int $sc2eId): self
    {
        $this->sc2eId = $sc2eId;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getRace(): ?string
    {
        return $this->race;
    }

    public function setRace(string $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getDomVal(): ?float
    {
        return $this->domVal;
    }

    public function setDomVal(?float $domVal): self
    {
        $this->domVal = $domVal;

        return $this;
    }

    public function getRomanizedName(): ?string
    {
        return $this->romanizedName;
    }

    public function setRomanizedName(?string $romanizedName): self
    {
        $this->romanizedName = $romanizedName;

        return $this;
    }

    public function getCurrentRating(): ?Rating
    {
        return $this->currentRating;
    }

    public function setCurrentRating(?Rating $currentRating): self
    {
        $this->currentRating = $currentRating;

        return $this;
    }

    public function getDomEnd(): ?Period
    {
        return $this->domEnd;
    }

    public function setDomEnd(?Period $domEnd): self
    {
        $this->domEnd = $domEnd;

        return $this;
    }

    public function getDomStart(): ?Period
    {
        return $this->domStart;
    }

    public function setDomStart(?Period $domStart): self
    {
        $this->domStart = $domStart;

        return $this;
    }


}
