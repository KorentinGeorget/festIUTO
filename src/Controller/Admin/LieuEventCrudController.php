<?php

namespace App\Controller\Admin;

use App\Entity\LieuEvent;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LieuEventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return LieuEvent::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $fields = [
            IdField::new('id', 'ID')->onlyOnIndex(),
            TextField::new('nomLieu', 'Nom du lieu'),
            TextField::new('adresse', 'Adresse'),
            NumberField::new('nombrePlaceLieu', 'Nombre de places'),
            AssociationField::new('evenements', 'Événements')
                ->setFormTypeOption('disabled', true),
            // CollectionField::new('tempsTransport', 'Temps de transport')
            //     ->setFormTypeOption('disabled', true),
        ];

        return $fields;
    }
    
}
