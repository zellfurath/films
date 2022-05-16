<?php

namespace App\Controller;

use App\Entity\Casting;
use App\Form\CastingType;
use App\Repository\CastingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/casting')]
class AdminCastingController extends AbstractController
{
    #[Route('/', name: 'app_admin_casting_index', methods: ['GET'])]
    public function index(CastingRepository $castingRepository): Response
    {
        return $this->render('admin_casting/index.html.twig', [
            'castings' => $castingRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_casting_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CastingRepository $castingRepository): Response
    {
        $casting = new Casting();
        $form = $this->createForm(CastingType::class, $casting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $castingRepository->add($casting);
            return $this->redirectToRoute('app_admin_casting_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_casting/new.html.twig', [
            'casting' => $casting,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_casting_show', methods: ['GET'])]
    public function show(Casting $casting): Response
    {
        return $this->render('admin_casting/show.html.twig', [
            'casting' => $casting,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_casting_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Casting $casting, CastingRepository $castingRepository): Response
    {
        $form = $this->createForm(CastingType::class, $casting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $castingRepository->add($casting);
            return $this->redirectToRoute('app_admin_casting_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_casting/edit.html.twig', [
            'casting' => $casting,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_casting_delete', methods: ['POST'])]
    public function delete(Request $request, Casting $casting, CastingRepository $castingRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$casting->getId(), $request->request->get('_token'))) {
            $castingRepository->remove($casting);
        }

        return $this->redirectToRoute('app_admin_casting_index', [], Response::HTTP_SEE_OTHER);
    }
}
