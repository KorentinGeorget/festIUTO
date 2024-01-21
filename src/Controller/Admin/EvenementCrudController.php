<?php

namespace App\Controller\Admin;

use App\Entity\Evenement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EvenementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Evenement::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $fields = [
            IdField::new('id', 'ID')
                ->onlyOnIndex(),
            TextField::new('nom','Nom'),
            DateTimeField::new('dateEv','Date'),
            DateTimeField::new('heureDebut','Heure de début')
                ->setFormat('HH:mm:ss'),
            DateTimeField::new('tempsMontage','Temps de montage')
                ->setFormat('HH:mm:ss'),
            DateTimeField::new('dureeEv','Durée')
                ->setFormat('HH:mm:ss'),
            DateTimeField::new('tempsDemontage','Temps de démontage')
                ->setFormat('HH:mm:ss'),
            AssociationField::new('typeEvent','Type d\'évènement')
                ->hideOnForm(),
            AssociationField::new('lieuEvent','Lieu')
                ->hideOnForm(),
            AssociationField::new('groupe','Groupe')
                ->hideOnForm(),
            AssociationField::new('festival','Festival')
                ->hideOnForm(),
            CollectionField::new('spectateurs', 'Nombre de spectateurs')
                ->formatValue(function ($value, $entity) {
                    return count($entity->getSpectateurs());
                }),
        ];

        if (in_array($pageName, ['edit', 'new'])){
            $fields[] = AssociationField::new('spectateurs', 'Spectateurs')
                ->setFormTypeOption('disabled', true);
            $fields[] = AssociationField::new('typeEvent', 'Type d\'évènement');
            $fields[] = AssociationField::new('lieuEvent', 'Lieu');
            $fields[] = AssociationField::new('groupe', 'Groupe');
            $fields[] = AssociationField::new('festival', 'Festival');
            
        }

        return $fields;
    }
    
}
