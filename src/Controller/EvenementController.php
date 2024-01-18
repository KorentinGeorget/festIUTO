<?php

namespace App\Controller;

use App\Entity\Festival;
use App\Repository\EvenementRepository;
use App\Repository\FestivalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvenementController extends AbstractController
{
    #[Route('/evenementsMembre/{id}', name: 'participationsMembre')]
    public function participationsMembre(EvenementRepository $evenementRepository): Response
    {
        return $this->render('pages/evenement/evenementsMembre.html.twig', [
            'evenements' => $evenementRepository->findEvenementsByMembre($this->getUser()->getMembre()->getGroupe())
        ]);
    }
    

    #[Route('/evenementsFestival/{id}', name: 'evenementsFestival')]
    public function evenementsFestival(Festival $festival,EvenementRepository $evenementRepository): Response
    {
        return $this->render('pages/evenement/evenementsFestival.html.twig', [
            'evenements' => $evenementRepository->findEvenementsByFestival($festival->getId())
        ]);
    }

    #[Route('/evenement/{id}', name: 'evenement.show')]
    public function show() : Response
    {
        return $this->render('pages/evenement/show.html.twig');
    }

}
