<?php

namespace App\Form;

use App\Entity\Instrument;
use App\Repository\InstrumentRepository;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InstrumentTypeMembre extends AbstractType
{
    private InstrumentRepository $instrument;

    public function __construct(InstrumentRepository $instrument)
    {
        $this->instrument = $instrument;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $instruments = $this->instrument->findAll();

        $choices = [];
        foreach ($instruments as $instrument) {
            $choices[$instrument->getNomInstrument()] = $instrument->getId();
        }

        $builder
            ->add('nomInstrument', ChoiceType::class, [
                'label' => 'Nouvelle instrument',
                'choices' => $choices,
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'Ajouter'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Instrument::class,
        ]);
    }
}
