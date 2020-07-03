<?php

namespace App\Entity;

use App\Repository\AircraftRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;


/**
 * @ORM\Entity(repositoryClass=AircraftRepository::class)
 */
class Aircraft
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $manufacturer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $basicType;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Flight", mappedBy="aircraft")
     */
    private $flights;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getManufacturer(): ?string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(string $manufacturer): self
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getBasicType(): ?string
    {
        return $this->basicType;
    }

    public function setBasicType(string $basicType): self
    {
        $this->basicType = $basicType;

        return $this;
    }

    /**
     * @return Collection|Flight[]
     */
    public function getFlights(): Collection
    {
        return $this->flights;
    }

    public function addFlight(Flight $flight)
    {
        if (!$this->flights->contains($flight)) {
            $this->flights[] = $flight;
            $flight->setAircraft($this);
        }

        return $this;
    }
}
