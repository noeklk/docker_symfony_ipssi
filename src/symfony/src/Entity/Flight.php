<?php

namespace App\Entity;

use App\Repository\FlightRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FlightRepository::class)
 */
class Flight
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
     * @ORM\Column(type="string", length=6)
     */
    private $number;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="App\Entity\Airport", inversedBy="departures")
     * @ORM\JoinColumn(name="departure_id", referencedColumnName="id") 
     */
    private $departure;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="App\Entity\Airport", inversedBy="arrivals")
     * @ORM\JoinColumn(name="arrival_id", referencedColumnName="id") 
     */
    private $arrival;

    /**
     * Many Flights have Many Passengers.
     * @ORM\ManyToMany(targetEntity="App\Entity\Passenger", inversedBy="flights")
     * @ORM\JoinTable(name="flight_passenger")
     */
    private $passengers;

    /**
     * @ORM\Column(type="string", type="decimal", precision=7, scale=2, nullable=true)
     */
    private $price;
}
