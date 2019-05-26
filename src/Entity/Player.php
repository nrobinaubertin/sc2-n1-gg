<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use App\Controller\PlayerSearchApi;

/**
 * Player
 *
 * @ORM\Table(name="player")
 * @ORM\Entity
 * @ApiResource(
 *     itemOperations={"get"},
 *     collectionOperations={
 *         "get",
 *         "search_player"={
 *             "method"="GET",
 *             "path"="/players/search",
 *             "controller"=PlayerSearchApi::class,
 *             "defaults"={"_api_receive"=false}
 *         },
 *     },
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
     * @var string|null
     *
     * @ORM\Column(name="romanized_name", type="string", length=100, nullable=true)
     */
    private $romanizedName;

    /**
     * @ORM\Column(name="aliases", type="simple_array", nullable=true)
     */
    private $aliases;

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

    public function getRomanizedName(): ?string
    {
        return $this->romanizedName;
    }

    public function setRomanizedName(?string $romanizedName): self
    {
        $this->romanizedName = $romanizedName;

        return $this;
    }

    public function getAliases(): ?array
    {
        return $this->aliases;
    }

    public function setAliases(array $aliases): self
    {
        $this->aliases = $aliases;
        return $this;
    }
}
