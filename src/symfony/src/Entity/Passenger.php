<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 */
class Passenger
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
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Ne peut pas être vide")
     * @Assert\Length(min=2, minMessage="Ne peut pas faire moins de {{ limit }} caractères", max=50, maxMessage="Ne peut pas faire plus de {{ limit }} caractères")
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Ne peut pas être vide")
     * @Assert\Length(min=2, minMessage="Ne peut pas faire moins de 2 caractères", max=50, maxMessage="Ne peut pas faire plus de 50 caractères")
     */
    private $lastName;

    /**
     * @var string
     *
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
