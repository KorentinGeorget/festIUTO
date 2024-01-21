<?php

namespace App\Controller\Admin;

use App\Entity\TempsTransport;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TempsTransportCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TempsTransport::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $fields = [
            IdField::new('id')->onlyOnIndex(),
            AssociationField::new('lieu1', 'Lieu 1'),
            AssociationField::new('lieu2', 'Lieu 2'),
            DateTimeField::new('temps', 'Temps')
            ->setFormat('HH:mm:ss'),
        ];

        return $fields;
    }
    
}
