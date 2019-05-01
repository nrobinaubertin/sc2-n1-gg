<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * Eventadjacency
 *
 * @ORM\Table(name="eventadjacency", indexes={@ORM\Index(name="eventadjacency_child_id", columns={"child_id"}), @ORM\Index(name="eventadjacency_parent_id", columns={"parent_id"})})
 * @ORM\Entity
 */
class Eventadjacency
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="eventadjacency_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="distance", type="integer", nullable=true)
     */
    private $distance;

    /**
     * @var \Event
     *
     * @ORM\ManyToOne(targetEntity="Event")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="child_id", referencedColumnName="id")
     * })
     * @MaxDepth(1)
     */
    private $child;

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

    public function getDistance(): ?int
    {
        return $this->distance;
    }

    public function setDistance(?int $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function getChild(): ?Event
    {
        return $this->child;
    }

    public function setChild(?Event $child): self
    {
        $this->child = $child;

        return $this;
    }

    public function getParent(): ?Event
    {
        return $this->parent;
    }

    public function setParent(?Event $parent): self
    {
        $this->parent = $parent;

        return $this;
    }


}
