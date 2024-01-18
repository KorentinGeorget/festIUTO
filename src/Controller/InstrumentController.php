<?php

namespace App\Controller;


use App\Entity\Membre;
use App\Form\InstrumentTypeMembre;
use App\Repository\InstrumentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InstrumentController extends AbstractController
{

    #[Route('/instrument/new/', name: 'instrument.new')]
    public function newInstrumentMembre(Request $request, EntityManagerInterface $manager, InstrumentRepository $instrumentRepository) : Response
    {

        $membre = new Membre();
        $form = $this->createForm(InstrumentTypeMembre::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $instrument = $instrumentRepository->find($form->getData()->getNomInstrument());
            $membre = $this->getUser()->getMembre();
            $membre->addInstrument($instrument);
            $manager->persist($membre);
            $manager->flush();


            return $this->redirectToRoute('user.show', ['id' => $membre->getUser()->getId()]);
        }

        return $this->render('pages/instrument/newInstrumentMembre.html.twig', [
            'form' => $form->createView()
        ]);
    }


}