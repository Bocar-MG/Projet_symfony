<?php

namespace App\Entity;

use App\Repository\SpectacleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SpectacleRepository::class)
 */
class Spectacle
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
    private $NomS;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Artiste;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomS(): ?string
    {
        return $this->NomS;
    }

    public function setNomS(string $NomS): self
    {
        $this->NomS = $NomS;

        return $this;
    }

    public function getArtiste(): ?string
    {
        return $this->Artiste;
    }

    public function setArtiste(string $Artiste): self
    {
        $this->Artiste = $Artiste;

        return $this;
    }
}
