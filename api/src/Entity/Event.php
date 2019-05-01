<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event", indexes={@ORM\Index(name="event_type", columns={"type"}), @ORM\Index(name="event_latest", columns={"latest"}), @ORM\Index(name="event_idx", columns={"idx"}), @ORM\Index(name="event_closed", columns={"closed"}), @ORM\Index(name="event_prizepool", columns={"prizepool"}), @ORM\Index(name="event_parent_id", columns={"parent_id"}), @ORM\Index(name="event_earliest", columns={"earliest"}), @ORM\Index(name="event_category", columns={"category"}), @ORM\Index(name="event_noprint", columns={"noprint"})})
 * @ORM\Entity
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
     */
    private $parent;


}
