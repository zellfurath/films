<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FilmRepository::class)]
class Film
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $nom;

    #[ORM\Column(type: 'integer')]
    private $anneeSortie;

    #[ORM\Column(type: 'integer')]
    private $duree;

    #[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: 'films')]
    private $genres;

    #[ORM\ManyToOne(targetEntity: Pays::class, inversedBy: 'films')]
    #[ORM\JoinColumn(nullable: false)]
    private $pays;

    #[ORM\OneToOne(inversedBy: 'film', targetEntity: Lien::class, cascade: ['persist', 'remove'])]
    private $lien;

    #[ORM\ManyToMany(targetEntity: Casting::class, inversedBy: 'filmsRealises')]
    #[ORM\JoinTable(name: 'realisateurs')]
    private $realisateurs;

    #[ORM\ManyToMany(targetEntity: Casting::class, inversedBy: 'filmsInterpretes')]
    #[ORM\JoinTable(name: 'acteurs')]
    private $acteurs;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image;

    public function __construct()
    {
        $this->genres = new ArrayCollection();
        $this->realisateurs = new ArrayCollection();
        $this->acteurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAnneeSortie(): ?int
    {
        return $this->anneeSortie;
    }

    public function setAnneeSortie(int $anneeSortie): self
    {
        $this->anneeSortie = $anneeSortie;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genres->contains($genre)) {
            $this->genres[] = $genre;
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        $this->genres->removeElement($genre);

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getLien(): ?Lien
    {
        return $this->lien;
    }

    public function setLien(?Lien $lien): self
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * @return Collection<int, Casting>
     */
    public function getRealisateurs(): Collection
    {
        return $this->realisateurs;
    }

    public function addRealisateur(Casting $realisateur): self
    {
        if (!$this->realisateurs->contains($realisateur)) {
            $this->realisateurs[] = $realisateur;
        }

        return $this;
    }

    public function removeRealisateur(Casting $realisateur): self
    {
        $this->realisateurs->removeElement($realisateur);

        return $this;
    }

    /**
     * @return Collection<int, Casting>
     */
    public function getActeurs(): Collection
    {
        return $this->acteurs;
    }

    public function addActeur(Casting $acteur): self
    {
        if (!$this->acteurs->contains($acteur)) {
            $this->acteurs[] = $acteur;
        }

        return $this;
    }

    public function removeActeur(Casting $acteur): self
    {
        $this->acteurs->removeElement($acteur);

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
