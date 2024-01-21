<?php

namespace App\Controller\Admin;

use App\Entity\PossedeBillet;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PossedeBilletCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PossedeBillet::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $fields = [
            IdField::new('id')->onlyOnIndex(),
            AssociationField::new('spectateur', 'Spectateur'),
            AssociationField::new('billet', 'Billet'),
            DateTimeField::new('dateObtention', 'Date d\'obtention'),
        ];

        return $fields;
    }
    
}
