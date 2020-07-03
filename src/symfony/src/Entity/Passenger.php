<?php

namespace App\Entity;


use App\Repository\PassengerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PassengerRepository::class)
 */
class Passenger
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Ne peut pas être vide")
     * @Assert\Length(min=2, minMessage="Ne peut pas faire moins de {{ limit }} caractères", max=50, maxMessage="Ne peut pas faire plus de {{ limit }} caractères")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Ne peut pas être vide")
     * @Assert\Length(min=2, minMessage="Ne peut pas faire moins de 2 caractères", max=50, maxMessage="Ne peut pas faire plus de 50 caractères")
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=15, unique=true)
     * @Assert\NotBlank(message="Ne peut pas être vide")
     * @Assert\Regex("/^[0-9]{2}[A-Z]{2}[0-9]{5}$/", message="Format invalide (00XX0000)")
     */
    private $passportNumber;

    /**
     * Many Passengers have Many Flights.
     * @ORM\ManyToMany(targetEntity="App\Entity\Flight", mappedBy="passengers")
     */
    private $flights;

    public function __construct()
    {
        $this->flights = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPassportNumber(): ?string
    {
        return $this->passportNumber;
    }

    public function setPassportNumber(string $passportNumber): self
    {
        $this->passportNumber = $passportNumber;

        return $this;
    }

    /**
     * @return Collection|Flight[]
     */
    public function getFlights(): Collection
    {
        return $this->flights;
    }

    public function addFlight(Flight $flight): self
    {
        if (!$this->flights->contains($flight)) {
            $this->flights[] = $flight;
            $flight->addPassenger($this);
        }

        return $this;
    }

    public function removeFlight(Flight $flight): self
    {
        if ($this->flights->contains($flight)) {
            $this->flights->removeElement($flight);
            $flight->removePassenger($this);
        }

        return $this;
    }
}
