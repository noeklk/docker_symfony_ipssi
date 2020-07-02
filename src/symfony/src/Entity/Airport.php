<?php

namespace App\Entity;

use App\Repository\AirportRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AirportRepository::class)
 */
class Airport
{
    /**
     * @var int
     * 
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $ident;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $typeA;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=130, nullable=true)
     */
    private $name;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", type="decimal", precision=20, scale=17, nullable=true)
     */
    private $latitudeDeg;

    /**
     * @var string
     * 
     * @ORM\Column(type="decimal", precision=20, scale=17, nullable=true)
     */
    private $longitudeDeg;

    /**
     * @var int
     * 
     * @ORM\Column(type="integer", type="integer", nullable=true)
     */
    private $elevationFt;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $isoCountry;

    /**
     * @var string
     *
     * @ORM\Column(type="string", type="string", length=50, nullable=true)
     */
    private $municipality;

    /**
     * @var string
     *
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
