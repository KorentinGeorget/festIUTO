<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints as Assert;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class, [
            'attr' => [
                'minlength' => 2,
                'maxlength' => 20,
            ],
            'label' => 'Votre nom',
            'constraints' => [
                new Assert\NotBlank(),
                new Assert\Length([
                    'min' => 2,
                    'max' => 20,
                ]),
            ]
        ])
        ->add('prenom', TextType::class, [
            'attr' => [
                'minlength' => 2,
                'maxlength' => 20,
            ],
            'label' => 'Votre prenom',
            'constraints' => [
                new Assert\NotBlank(),
                new Assert\Length([
                    'min' => 2,
                    'max' => 20,
                ]),
            ]
        ])
        ->add('plainPassword', PasswordType::class, [
            'label' => 'Mot de passe',
        ])
        ->add('submit', SubmitType::class);
    
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
