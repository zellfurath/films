<?php

namespace App\Controller;

use App\DTO\RechercheMulticriteresDTO;
use App\Form\RechercheMulticriteresType;
use App\Repository\FilmRepository;
use App\Repository\GenreRepository;
use App\Repository\PaysRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontEndController extends AbstractController
{
    #[Route("/front/film-detail/{filmId}", name: "film-detail")]
    public function detailFilm(FilmRepository $filmRepository, $filmId)
    {

        $film = $filmRepository->find($filmId);
        return $this->render("/front/film-detail.html.twig", [
            'leFilm' => $film
        ]);
    }

    #[Route('/')]
    public function accueil(GenreRepository $genreRepository, PaysRepository $paysRepository, Request $request, FilmRepository $filmRepository)
    {

        # Gestion formulaire et DTO recherche multicriteres
        $dto = new RechercheMulticriteresDTO();
        $form = $this->createForm(RechercheMulticriteresType::class, $dto);
        $form->handleRequest($request);

        # Liste tous les films
        $qb = $filmRepository->createQueryBuilder('f')
            ->orderBy('f.nom', 'asc');

        if ($form->isSubmitted()) {
            # on a fait un submit

            if ($dto->getNom() != null) {
                $qb->andWhere('f.nom LIKE :NOM')
                    ->setParameter('NOM', '%' . $dto->getNom() . '%');
            }

            if ($dto->getActeur() != null) {
                $qb->join('f.acteurs', 'a')
                    ->andWhere('a=:ACTEUR')
                    ->setParameter('ACTEUR', $dto->getActeur());
            }

            if ($dto->getPays() != null) {
                $qb->join('f.pays', 'p')
                    ->andWhere('p=:PAYS')
                    ->setParameter('PAYS', $dto->getPays());
            }

            if ($dto->getAnnee() != null) {
                $qb->andWhere('f.anneeSortie = :ANNEE')
                    ->setParameter('ANNEE', $dto->getAnnee());
            }

            if ($dto->getGenre() != null) {
                $qb->join('f.genres', 'g')
                    ->andWhere('g=:GENRE')
                    ->setParameter('GENRE', $dto->getGenre());
            }

            if ($dto->getRealisateur() != null) {
                $qb->join('f.realisateurs', 'r')
                    ->andWhere('r=:REALISATEUR')
                    ->setParameter('REALISATEUR', $dto->getRealisateur());
            }
        }

        $films = $qb->getQuery()->getResult();

        return $this->renderForm("/front/accueil.html.twig", [
            'lesFilms'=>$films,
            'formRecherche' => $form
        ]);
    }
}
