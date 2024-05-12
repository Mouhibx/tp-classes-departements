<?php

namespace App\Controller;

use App\Entity\Departement;
use App\Repository\DepartementRepository;
use App\Repository\SalleDeClasseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_dep')]
    public function index(DepartementRepository $repository): Response
    {
        $departements = $repository->findAll();
        return $this->render('main/departement.html.twig', [
            'departements' => $departements,
        ]);
    }

    #[Route('/{id}/salles', name: 'app_salles')]
    public function list($id, SalleDeClasseRepository $repository): Response
    {

        $salles = $repository->findBy(['departement' => $id]);
        return $this->render('main/salles.html.twig', [
            'salles' => $salles,
        ]);
    }
}
