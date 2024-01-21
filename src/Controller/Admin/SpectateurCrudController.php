<?php

namespace App\Controller\Admin;

use App\Entity\Spectateur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SpectateurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Spectateur::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $fields = [
            IdField::new('id', 'ID')->onlyOnIndex(),
            TextField::new('nom', 'Nom du spectateur'),
            TextField::new('prenom', 'Prénom du spectateur'),
            AssociationField::new('billets', 'Billets')
                ->setFormTypeOption('disabled', true),
            AssociationField::new('evenements', 'Événements'),
            AssociationField::new('groupeFavoris', 'GroupesFavoris'),
            AssociationField::new('user', 'Utilisateur'),

        ];

        return $fields;
    }
    
}
