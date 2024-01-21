<?php

namespace App\Controller;

use App\Entity\Groupe;
use App\Repository\GroupeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class GroupeController extends AbstractController
{

    #[Route('/groupe/index', name: 'groupe.index')]
    public function index(GroupeRepository $groupeRepository): Response
    {
        return $this->render('pages/groupe/index.html.twig', [
            'groupes' => $groupeRepository->findAll()
        ]);
    }

    #[IsGranted('ROLE_SPECTATEUR')]
    #[Route('/groupe/{id}/ajouter', name: 'groupe.ajouterFavoris')]
    public function ajouterFavoris(Groupe $groupe, EntityManagerInterface $manager): Response
    {
        $spectateur = $this->getUser()->getSpectateur();
        if(!$spectateur->getGroupeFavoris()->contains($groupe))
        {
            $spectateur->addGroupeFavori($groupe);
            $manager->persist($spectateur);
            $manager->flush();
            $this->addFlash('success', 'Le groupe a bien été ajouté à vos favoris');
        }else{
            $this->addFlash('warning', 'Le groupe est déjà dans vos favoris');
        }       
        return $this->redirectToRoute('groupe.index');
    }

    #[IsGranted('ROLE_SPECTATEUR')]
    #[Route('/groupe/{id}/retirer', name: 'groupe.enleverFavoris')]
    public function enleverFavoris(Groupe $groupe, EntityManagerInterface $manager): Response
    {
        $spectateur = $this->getUser()->getSpectateur();
        if($spectateur->getGroupeFavoris()->contains($groupe))
        {
            $spectateur->removeGroupeFavori($groupe);
            $manager->persist($spectateur);
            $manager->flush();
            $this->addFlash('success', 'Le groupe a bien été enlevé de vos favoris');
        }else{
            $this->addFlash('warning', 'Le groupe n\'est pas dans vos favoris');
        }       
        return $this->redirectToRoute('user.show' , ['id' => $this->getUser()->getId()]);
    }

}
