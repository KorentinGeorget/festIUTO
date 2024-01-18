<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserPasswordType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/utilisateur/edit/{id}', name: 'user.edit')]
    public function edit(User $user, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher): Response
    {
        if(!$this->getUser()){
            return $this->redirectToRoute('security.login');
        }

        if($this->getUser() !== $user){
            return $this->redirectToRoute('home');
        }

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if($hasher->isPasswordValid($user, $form->getData()->getPlainPassword())){
                $user = $form->getData();

                $this->addFlash('success', 'Votre compte a bien été modifié !');
    
                $manager->persist($user);
                $manager->flush();
    
                return $this->redirectToRoute('home');
            }
            else{
                $this->addFlash('warning', 'Le mot de passe est incorrect !');
                return $this->redirectToRoute('user.edit', ['id' => $user->getId()]);
            }
        }

        return $this->render('pages/user/edit.html.twig', [
            'form' => $form->createView()
        ]);

    }

    #[Route('/utilisateur/editMotDePasse/{id}', name: 'user.editMotDePasse')]
    public function editPassword(User $user, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher) : Response
    {
        $form = $this->createForm(UserPasswordType::class);


        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if($hasher->isPasswordValid($user, $form->getData()['plainPassword'])){
                
                $user->setPassword(
                    $hasher->hashPassword(
                        $user,
                        $form->getData()['newPassword']
                    )
                );

                $this->addFlash('success', 'Votre mot de passe a bien été modifié !');

                $manager->persist($user);
                $manager->flush();

                return $this->redirectToRoute('home');
            }
            else{
                $this->addFlash('warning', 'Le mot de passe est incorrect !');
                return $this->redirectToRoute('user.editMotDePasse', ['id' => $user->getId()]);
            }
        }

        return $this->render('pages/user/edit_password.html.twig', [
            'form' => $form->createView()
        ]);

    }
}
