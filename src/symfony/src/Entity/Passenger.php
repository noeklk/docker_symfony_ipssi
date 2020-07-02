<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
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
}
