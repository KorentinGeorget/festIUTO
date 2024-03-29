<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Festival;
use App\Repository\EvenementRepository;
use App\Repository\FestivalRepository;
use App\Repository\MembreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class EvenementController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/evenement/Membre/{id}', name: 'participationsMembre')]
    public function participationsMembre(EvenementRepository $evenementRepository): Response
    {
        if($this->getUser()->getMembre() == null){
            $eventsMembre = null;
        }else{
            $eventsMembre = $evenementRepository->findEvenementsByMembre($this->getUser()->getMembre()->getGroupe());
        }

        if($this->getUser()->getSpectateur() == null){
            $eventsSpectateur = null;
        }else{
        $eventsSpectateur =$evenementRepository->findEvenementBySpectateur($this->getUser()->getSpectateur());
        }
        
        return $this->render('pages/evenement/evenementsMembre.html.twig', [
            'evenementsMembre' => $eventsMembre,
            'evenementsSpectateur' => $eventsSpectateur
        ]);
    }
    

    #[Route('/evenement/Festival/{id}', name: 'evenementsFestival')]
    public function evenementsFestival(Festival $festival,EvenementRepository $evenementRepository): Response
    {
        return $this->render('pages/evenement/evenementsFestival.html.twig', [
            'evenements' => $evenementRepository->findEvenementsByFestival($festival->getId())
        ]);
    }

    #[Route('/evenement/{id}', name: 'evenement.show')]
    public function show(Evenement $evenement,EvenementRepository $evenementRepository, MembreRepository $membreRepository) : Response
    {

        // dd($membreRepository->findMembresIdByGroupe($evenement->getGroupe()->getId()));
        // dd($evenementRepository->find($evenement->getId()));
        $membres = $membreRepository->findMembresByGroupe($evenement->getGroupe()->getId());
        
        $idMembre=[];
        foreach($membres as $membre){
            $idMembre[]=$membre->getId();
        }

        // dd($idMembre);

        return $this->render('pages/evenement/show.html.twig', [
            'evenement' => $evenementRepository->find($evenement->getId()),
            'membres' => $idMembre
        ]);
    }

    #[IsGranted('ROLE_SPECTATEUR')]
    #[Route('/evenement/{id}/participe', name: 'evenement.participe')]
    public function participe(Evenement $evenement, EntityManagerInterface $manager): Response
    {

        if ($evenement->getSpectateurs()->count() >= $evenement->getLieuEvent()->getNombrePlaceLieu()) {
            $this->addFlash('warning', 'Il n\'y a plus de place disponible pour cet événement !');
            return $this->redirectToRoute('evenementsFestival', ['id' => $evenement->getFestival()->getId()]);
        } 

        $eventDateTime = new \DateTime($evenement->getDateEv()->format('Y-m-d') . ' ' . $evenement->getHeureDebut()->format('H:i:s'));
        if($eventDateTime < new \DateTime('now')){
            $this->addFlash('warning', 'Cet événement est déjà passé !');
            return $this->redirectToRoute('evenementsFestival', ['id' => $evenement->getFestival()->getId()]);
        }

        if(!$evenement->getTypeEvent()->isIsPublic()){
            $this->addFlash('warning', 'Cet événement n\'est pas accessible au public !');
            return $this->redirectToRoute('evenementsFestival', ['id' => $evenement->getFestival()->getId()]);
        }

        // if($evenement->isIsPayant()){
        //     $this->addFlash('warning', 'Cet événement est payant !');
        //     return $this->redirectToRoute('evenementsFestival', ['id' => $evenement->getFestival()->getId()]);
        // }

        $spectateur = $this->getUser()->getSpectateur();
        if (!$evenement->getSpectateurs()->contains($spectateur)) {
            if(!$evenement->getGroupe()->getMembres()->contains($this->getUser()->getMembre())){
            $spectateur->addEvenement($evenement);
            $manager->persist($spectateur);
            $manager->flush();
            $this->addFlash('success', 'Vous participez à l\'événement !');
            return $this->redirectToRoute('evenement.show', ['id' => $evenement->getId()]);
            }
            else{
                $this->addFlash('warning', 'Vous ne pouvez pas participer à l\'événement car vous êtes membre du groupe !');
                return $this->redirectToRoute('evenementsFestival', ['id' => $evenement->getFestival()->getId()]);
            }
        }
        else{
            $this->addFlash('warning', 'Vous participez déjà à l\'événement !');
            return $this->redirectToRoute('evenementsFestival', ['id' => $evenement->getFestival()->getId()]);
        }
        return $this->redirectToRoute('evenement.show', ['id' => $evenement->getId()]);

        
    }

}
