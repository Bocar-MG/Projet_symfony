<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FilmRepository::class)
 */
class Film
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
    private $Titre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="binary", nullable=true)
     */
    private $Affiche;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $BandeAnnonce;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="films")
     */
    private $Categorie;

    /**
     * @ORM\OneToMany(targetEntity=Seance::class, mappedBy="film")
     */
    private $salle;

    public function __construct()
    {
        $this->salle = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getAffiche()
    {
        return $this->Affiche;
    }

    public function setAffiche($Affiche): self
    {
        $this->Affiche = $Affiche;

        return $this;
    }

    public function getBandeAnnonce(): ?string
    {
        return $this->BandeAnnonce;
    }

    public function setBandeAnnonce(?string $BandeAnnonce): self
    {
        $this->BandeAnnonce = $BandeAnnonce;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->Categorie;
    }

    public function setCategorie(?Categorie $Categorie): self
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    /**
     * @return Collection<int, Seance>
     */
    public function getSalle(): Collection
    {
        return $this->salle;
    }

    public function addSalle(Seance $salle): self
    {
        if (!$this->salle->contains($salle)) {
            $this->salle[] = $salle;
            $salle->setFilm($this);
        }

        return $this;
    }

    public function removeSalle(Seance $salle): self
    {
        if ($this->salle->removeElement($salle)) {
            // set the owning side to null (unless already changed)
            if ($salle->getFilm() === $this) {
                $salle->setFilm(null);
            }
        }

        return $this;
    }
    public function __toString() {
        return $this->Titre;
    }

    
}
