<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Airport
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $ident;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $typeA;

    /**
     * @ORM\Column(type="string", length=130, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", type="decimal", precision=20, scale=17, nullable=true)
     */
    private $latitudeDeg;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=17, nullable=true)
     */
    private $longitudeDeg;

    /**
     * @ORM\Column(type="integer", type="integer", nullable=true)
     */
    private $elevationFt;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $isoCountry;

    /**
     * @ORM\Column(type="string", type="string", length=50, nullable=true)
     */
    private $municipality;

    /**
     * @ORM\Column(type="string", type="string", length=3, nullable=true)
     */
    private $iataCode;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Flight", mappedBy="departure", cascade={"remove", "persist"})
     */
    private $departures;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Flight", mappedBy="arrival", cascade={"remove","persist"})
     */
    private $arrivals;
}
