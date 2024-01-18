<?php

namespace App\Controller;

use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET'])]
    public function index(EvenementRepository $evenementRepository): Response
    {


        return $this->render('pages/home.html.twig', [
            'evenements' => $evenementRepository->findAll(),
        ]);
    }
}
