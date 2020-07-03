<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FlightRepository")
 */
class Flight
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $number;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Airport", inversedBy="departures")
     * @ORM\JoinColumn(name="departure_id", referencedColumnName="id") 
     */
    private $departure;

    /**
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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Aircraft", inversedBy="flights")
     * @ORM\JoinColumn(name="aircraft_id", referencedColumnName="id")
     */
    private $aircraft;

    public function __construct()
    {
        $this->passengers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDeparture(): ?Airport
    {
        return $this->departure;
    }

    public function setDeparture(?Airport $departure): self
    {
        $this->departure = $departure;

        return $this;
    }

    public function getArrival(): ?Airport
    {
        return $this->arrival;
    }

    public function setArrival(?Airport $arrival): self
    {
        $this->arrival = $arrival;

        return $this;
    }

    /**
     * @return Collection|Passenger[]
     */
    public function getPassengers(): Collection
    {
        return $this->passengers;
    }

    public function addPassenger(Passenger $passenger): self
    {
        if (!$this->passengers->contains($passenger)) {
            $this->passengers[] = $passenger;
        }

        return $this;
    }

    public function removePassenger(Passenger $passenger): self
    {
        if ($this->passengers->contains($passenger)) {
            $this->passengers->removeElement($passenger);
        }

        return $this;
    }
}
