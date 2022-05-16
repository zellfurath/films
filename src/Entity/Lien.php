<?php

namespace App\Entity;

use App\Repository\LienRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LienRepository::class)]
class Lien
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $url;

    #[ORM\OneToOne(mappedBy: 'lien', targetEntity: Film::class, cascade: ['persist', 'remove'])]
    private $film;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getFilm(): ?Film
    {
        return $this->film;
    }

    public function setFilm(?Film $film): self
    {
        // unset the owning side of the relation if necessary
        if ($film === null && $this->film !== null) {
            $this->film->setLien(null);
        }

        // set the owning side of the relation if necessary
        if ($film !== null && $film->getLien() !== $this) {
            $film->setLien($this);
        }

        $this->film = $film;

        return $this;
    }
}
