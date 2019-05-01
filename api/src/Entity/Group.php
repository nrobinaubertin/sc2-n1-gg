<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Group
 *
 * @ORM\Table(name="group", indexes={@ORM\Index(name="group_name_like", columns={"name"}), @ORM\Index(name="group_is_team", columns={"is_team"}), @ORM\Index(name="group_name", columns={"name"}), @ORM\Index(name="group_active", columns={"active"})})
 * @ORM\Entity
 */
class Group
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


}
