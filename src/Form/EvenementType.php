<?php

namespace App\Form;

use App\Entity\Evenement;
use App\Entity\Groupe;
use App\Entity\LieuEvent;
use App\Entity\Spectateur;
use App\Entity\TypeEvent;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('dateEv')
            ->add('heureDebut')
            ->add('tempsMontage')
            ->add('dureeEv')
            ->add('tempsDemontage')
            ->add('isPayant')
            ->add('typeEvent', EntityType::class, [
                'class' => TypeEvent::class,
'choice_label' => 'id',
            ])
            ->add('lieuEvent', EntityType::class, [
                'class' => LieuEvent::class,
'choice_label' => 'id',
            ])
            ->add('groupe', EntityType::class, [
                'class' => Groupe::class,
'choice_label' => 'id',
            ])
            ->add('spectateurs', EntityType::class, [
                'class' => Spectateur::class,
'choice_label' => 'id',
'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
