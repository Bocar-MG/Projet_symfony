<?php

namespace App\Entity;

use App\Repository\SeanceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SeanceRepository::class)
 */
class Seance
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $Date;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $Heure;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Etat;

    /**
     * @ORM\ManyToOne(targetEntity=Film::class, inversedBy="salle")
     */
    private $film;

    /**
     * @ORM\ManyToOne(targetEntity=Salle::class, inversedBy="seances")
     */
    private $salle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(?\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getHeure(): ?\DateTimeInterface
    {
        return $this->Heure;
    }

    public function setHeure(?\DateTimeInterface $Heure): self
    {
        $this->Heure = $Heure;

        return $this;
    }

    public function getEtat(): ?bool
    {
        return $this->Etat;
    }

    public function setEtat(?bool $Etat): self
    {
        $this->Etat = $Etat;

        return $this;
    }

    public function getFilm(): ?Film
    {
        return $this->film;
    }

    public function setFilm(?Film $film): self
    {
        $this->film = $film;

        return $this;
    }

    public function getSalle(): ?Salle
    {
        return $this->salle;
    }

    public function setSalle(?Salle $salle): self
    {
        $this->salle = $salle;

        return $this;
    }
}
