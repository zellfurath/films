<?php

namespace App\DTO;

class RechercheMulticriteresDTO
{

    private $annee;
    private $nom;
    private $acteur;
    private $realisateur;
    private $pays;
    private $genre;

    /**
     * @return mixed
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * @param mixed $annee
     * @return RechercheMulticriteresDTO
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     * @return RechercheMulticriteresDTO
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getActeur()
    {
        return $this->acteur;
    }

    /**
     * @param mixed $acteur
     * @return RechercheMulticriteresDTO
     */
    public function setActeur($acteur)
    {
        $this->acteur = $acteur;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRealisateur()
    {
        return $this->realisateur;
    }

    /**
     * @param mixed $realisateur
     * @return RechercheMulticriteresDTO
     */
    public function setRealisateur($realisateur)
    {
        $this->realisateur = $realisateur;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * @param mixed $pays
     * @return RechercheMulticriteresDTO
     */
    public function setPays($pays)
    {
        $this->pays = $pays;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     * @return RechercheMulticriteresDTO
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
        return $this;
    }



}