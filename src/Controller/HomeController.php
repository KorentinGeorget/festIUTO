<?php

namespace App\Controller;

use App\Repository\EvenementRepository;
use App\Repository\FestivalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET'])]
    public function index(FestivalRepository $festivalRepository, EvenementRepository $evenementRepository): Response
    {
        if($this->getUser()){
            $evenementsGroupeFavoris  = $evenementRepository->findEvenementWhereGroupeFavoris($this->getUser()->getSpectateur()->getGroupeFavoris());
        } else {
            $evenementsGroupeFavoris = null;
        }

        // dd($evenementsGroupeFavoris);


        return $this->render('pages/home.html.twig', [
            'festivals' => $festivalRepository->findAllNonFinished(),
            'evenementsGroupeFavoris' => $evenementsGroupeFavoris
        ]);
    }
}
