<?php

namespace App\Controller\Admin;

use App\Entity\TypeBillet;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TypeBilletCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeBillet::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $fields = [
            IdField::new('id', 'ID')->onlyOnIndex(),
            TextField::new('TypeBillet', 'Nom du type de billet'),
            DateTimeField::new('dureeBillet', 'Durée du billet')
                ->setFormat( 'HH:mm:ss'),
            AssociationField::new('spectateurs', 'Spectateurs')
                ->setFormTypeOption('disabled', true),
        ];

        return $fields;
    }
    
}
