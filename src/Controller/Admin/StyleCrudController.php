<?php

namespace App\Controller\Admin;

use App\Entity\Style;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class StyleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Style::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $fields = [
            IdField::new('id', 'ID')->onlyOnIndex(),
            TextField::new('nomStyle', 'Nom du style'),
            AssociationField::new('styleSimilaires', 'Styles similaires')
                ->setFormTypeOption('multiple', true),
            AssociationField::new('groupes', 'Groupes')
                ->setFormTypeOption('disabled', true),
            
        ];

        return $fields;
    }
    
}
