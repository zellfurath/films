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

    #[Route('/',name: 'accueil')]
    public function accueil(FilmRepository $filmRepository, Request $request)
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

            $films = $filmRepository->filtreMulticriteres($dto->getNom(),$dto->getAnnee(),$dto->getActeur(), $dto->getRealisateur(),$dto->getGenre(),$dto->getPays());
        }else{
            $qb = $filmRepository->createQueryBuilder('f')
                ->orderBy('f.nom', 'asc');
            $films = $qb->getQuery()->getResult();
        }

        return $this->renderForm("/front/accueil.html.twig", [
            'lesFilms'=>$films,
            'formRecherche' => $form
        ]);
    }
}
