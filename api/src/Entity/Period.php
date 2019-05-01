<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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


}
