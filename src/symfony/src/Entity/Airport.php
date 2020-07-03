<?php

namespace App\Entity;


use App\Repository\AirportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AirportRepository::class)
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

    public function __construct()
    {
        $this->departures = new ArrayCollection();
        $this->arrivals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdent(): ?string
    {
        return $this->ident;
    }

    public function setIdent(?string $ident): self
    {
        $this->ident = $ident;

        return $this;
    }

    public function getTypeA(): ?string
    {
        return $this->typeA;
    }

    public function setTypeA(?string $typeA): self
    {
        $this->typeA = $typeA;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLatitudeDeg(): ?string
    {
        return $this->latitudeDeg;
    }

    public function setLatitudeDeg(?string $latitudeDeg): self
    {
        $this->latitudeDeg = $latitudeDeg;

        return $this;
    }

    public function getLongitudeDeg(): ?string
    {
        return $this->longitudeDeg;
    }

    public function setLongitudeDeg(?string $longitudeDeg): self
    {
        $this->longitudeDeg = $longitudeDeg;

        return $this;
    }

    public function getElevationFt(): ?int
    {
        return $this->elevationFt;
    }

    public function setElevationFt(?int $elevationFt): self
    {
        $this->elevationFt = $elevationFt;

        return $this;
    }

    public function getIsoCountry(): ?string
    {
        return $this->isoCountry;
    }

    public function setIsoCountry(?string $isoCountry): self
    {
        $this->isoCountry = $isoCountry;

        return $this;
    }

    public function getMunicipality(): ?string
    {
        return $this->municipality;
    }

    public function setMunicipality(?string $municipality): self
    {
        $this->municipality = $municipality;

        return $this;
    }

    public function getIataCode(): ?string
    {
        return $this->iataCode;
    }

    public function setIataCode(?string $iataCode): self
    {
        $this->iataCode = $iataCode;

        return $this;
    }

    /**
     * @return Collection|Flight[]
     */
    public function getDepartures(): Collection
    {
        return $this->departures;
    }

    public function addDeparture(Flight $departure): self
    {
        if (!$this->departures->contains($departure)) {
            $this->departures[] = $departure;
            $departure->setDeparture($this);
        }

        return $this;
    }

    public function removeDeparture(Flight $departure): self
    {
        if ($this->departures->contains($departure)) {
            $this->departures->removeElement($departure);
            // set the owning side to null (unless already changed)
            if ($departure->getDeparture() === $this) {
                $departure->setDeparture(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Flight[]
     */
    public function getArrivals(): Collection
    {
        return $this->arrivals;
    }

    public function addArrival(Flight $arrival): self
    {
        if (!$this->arrivals->contains($arrival)) {
            $this->arrivals[] = $arrival;
            $arrival->setArrival($this);
        }

        return $this;
    }

    public function removeArrival(Flight $arrival): self
    {
        if ($this->arrivals->contains($arrival)) {
            $this->arrivals->removeElement($arrival);
            // set the owning side to null (unless already changed)
            if ($arrival->getArrival() === $this) {
                $arrival->setArrival(null);
            }
        }

        return $this;
    }
}
