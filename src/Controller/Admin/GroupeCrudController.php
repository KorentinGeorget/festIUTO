<?php

namespace App\Controller\Admin;

use App\Entity\Groupe;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GroupeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Groupe::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $fields = [
            IdField::new('id', 'ID')->onlyOnIndex(),
            TextField::new('nomGroupe', 'Nom du groupe'),
            AssociationField::new('evenements', 'Événements')
                ->setFormTypeOption('disabled', true),
            AssociationField::new('hebergements', 'Hébergements')
                ->setFormTypeOption('multiple', true),
            AssociationField::new('styles', 'Styles')
                ->setFormTypeOption('multiple', true),
            AssociationField::new('membres', 'Membres')
                ->setFormTypeOption('disabled', true),
        ];



        return $fields;
    }
    
}
