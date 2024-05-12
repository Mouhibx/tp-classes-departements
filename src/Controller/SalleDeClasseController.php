<?php

namespace App\Controller;

use App\Entity\SalleDeClasse;
use App\Form\SalleDeClasseType;
use App\Repository\SalleDeClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/salle/de/classe')]
class SalleDeClasseController extends AbstractController
{
    #[Route('/', name: 'app_salle_de_classe_index', methods: ['GET'])]
    public function index(SalleDeClasseRepository $salleDeClasseRepository): Response
    {
        return $this->render('salle_de_classe/index.html.twig', [
            'salle_de_classes' => $salleDeClasseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_salle_de_classe_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $salleDeClasse = new SalleDeClasse();
        $form = $this->createForm(SalleDeClasseType::class, $salleDeClasse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($salleDeClasse);
            $entityManager->flush();

            return $this->redirectToRoute('app_salle_de_classe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('salle_de_classe/new.html.twig', [
            'salle_de_classe' => $salleDeClasse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_salle_de_classe_show', methods: ['GET'])]
    public function show(SalleDeClasse $salleDeClasse): Response
    {
        return $this->render('salle_de_classe/show.html.twig', [
            'salle_de_classe' => $salleDeClasse,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_salle_de_classe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SalleDeClasse $salleDeClasse, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SalleDeClasseType::class, $salleDeClasse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_salle_de_classe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('salle_de_classe/edit.html.twig', [
            'salle_de_classe' => $salleDeClasse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_salle_de_classe_delete', methods: ['POST'])]
    public function delete(Request $request, SalleDeClasse $salleDeClasse, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$salleDeClasse->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($salleDeClasse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_salle_de_classe_index', [], Response::HTTP_SEE_OTHER);
    }
}
