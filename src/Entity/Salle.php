<?php

namespace App\Entity;

use App\Repository\SalleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SalleRepository::class)
 */
class Salle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Etat;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $NbrePlace;

    /**
     * @ORM\OneToMany(targetEntity=Seance::class, mappedBy="salle")
     */
    private $seances;

    public function __construct()
    {
        $this->seances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtat(): ?bool
    {
        return $this->Etat;
    }

    public function setEtat(bool $Etat): self
    {
        $this->Etat = $Etat;

        return $this;
    }

    public function getNbrePlace(): ?int
    {
        return $this->NbrePlace;
    }

    public function setNbrePlace(?int $NbrePlace): self
    {
        $this->NbrePlace = $NbrePlace;

        return $this;
    }

    /**
     * @return Collection<int, Seance>
     */
    public function getSeances(): Collection
    {
        return $this->seances;
    }

    public function addSeance(Seance $seance): self
    {
        if (!$this->seances->contains($seance)) {
            $this->seances[] = $seance;
            $seance->setSalle($this);
        }

        return $this;
    }

    public function removeSeance(Seance $seance): self
    {
        if ($this->seances->removeElement($seance)) {
            // set the owning side to null (unless already changed)
            if ($seance->getSalle() === $this) {
                $seance->setSalle(null);
            }
        }

        return $this;
    }
    public function __toString() {
        return   strval($this->id);
    }

}
