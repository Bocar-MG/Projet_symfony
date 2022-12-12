<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomclient;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomclient;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $emailclient;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephoneclient;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomclient(): ?string
    {
        return $this->nomclient;
    }

    public function setNomclient(string $nomclient): self
    {
        $this->nomclient = $nomclient;

        return $this;
    }

    public function getPrenomclient(): ?string
    {
        return $this->prenomclient;
    }

    public function setPrenomclient(string $prenomclient): self
    {
        $this->prenomclient = $prenomclient;

        return $this;
    }

    public function getEmailclient(): ?string
    {
        return $this->emailclient;
    }

    public function setEmailclient(string $emailclient): self
    {
        $this->emailclient = $emailclient;

        return $this;
    }

    public function getTelephoneclient(): ?string
    {
        return $this->telephoneclient;
    }

    public function setTelephoneclient(string $telephoneclient): self
    {
        $this->telephoneclient = $telephoneclient;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
