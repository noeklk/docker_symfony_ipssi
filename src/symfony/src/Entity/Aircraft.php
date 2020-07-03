<?php

namespace App\Entity;

use App\Repository\AircraftRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="string", length=50)
     */
    private $manufacturer;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $basicType;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Flight", mappedBy="aircraft")
     */
    private $flight;

    public function __construct()
    {
        $this->flight = new ArrayCollection();
    }

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
    public function getFlight(): Collection
    {
        return $this->flight;
    }

    public function addFlight(Flight $flight): self
    {
        if (!$this->flight->contains($flight)) {
            $this->flight[] = $flight;
            $flight->setAircraft($this);
        }

        return $this;
    }

    public function removeFlight(Flight $flight): self
    {
        if ($this->flight->contains($flight)) {
            $this->flight->removeElement($flight);
            // set the owning side to null (unless already changed)
            if ($flight->getAircraft() === $this) {
                $flight->setAircraft(null);
            }
        }

        return $this;
    }

    public function setFlight(string $flight): self
    {
        $this->flight = $flight;

        return $this;
    }
}
