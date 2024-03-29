<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Entity\Spectateur;
use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/connexion', name: 'security.login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {

        return $this->render('pages/security/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError()
        ]);
    }

    #[Route('/deconnexion', name: 'security.logout')]
    public function logout()
    {
        // Nothing to do here
    }

    #[Route('/inscription', name: 'security.registration')]
    public function registration(Request $request, EntityManagerInterface $manager) : Response
    {
        $user = new User();
        $user->setRoles(['ROLE_USER']);
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();

            $this->addFlash('success', 'Votre compte a bien été créé !');

            if(in_array("ROLE_MEMBRE", $form->get('roles')->getData())){
                $membre = new Membre();
                $membre->setNom($form->get('nom')->getData())
                    ->setPrenom($form->get('prenom')->getData())
                    ->setUser($user);
                $manager->persist($membre);

                $user->setMembre($membre);
            }

            if(in_array("ROLE_SPECTATEUR", $form->get('roles')->getData())){
                $spectateur = new Spectateur();
                $spectateur->setNom($form->get('nom')->getData())
                    ->setPrenom($form->get('prenom')->getData())
                    ->setUser($user);
                $manager->persist($spectateur);
                
                $user->setSpectateur($spectateur);
            }

            $userRoles = $form->get('roles')->getData();
            if(!in_array("ROLE_MEMBRE", $userRoles) && !in_array("ROLE_SPECTATEUR", $userRoles)){
                $this->addFlash('warning', 'Veuillez sélectionner au moins un rôle (MEMBRE ou SPECTATEUR).');
                return $this->redirectToRoute('security.registration');
            }

            $user->setRoles(['ROLE_USER', ...$userRoles]);
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('security.login');
        }
        
        
        return $this->render('pages/security/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
}
