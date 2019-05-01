<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     */
    private $child;

    /**
     * @var \Event
     *
     * @ORM\ManyToOne(targetEntity="Event")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * })
     */
    private $parent;


}
