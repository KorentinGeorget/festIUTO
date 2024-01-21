<?php

namespace App\Controller\Admin;

use App\Entity\Hebergement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class HebergementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Hebergement::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

        $fields = [
            IdField::new('id', 'ID'),
            TextField::new('nomHebergement', 'Nom de l\'hébergement'),
            TextField::new('adresse', 'Adresse de l\'hébergement'),
            NumberField::new('nbPlaceHebergement', 'Nombre de places'),
            AssociationField::new('groupes', 'groupes hébergés')
                ->setFormTypeOption('disabled', true),
        ];

        return $fields;
    }
    
}
