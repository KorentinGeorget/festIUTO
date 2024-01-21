<?php

namespace App\Controller\Admin;

use App\Entity\Evenement;
use App\Entity\Festival;
use App\Form\CollectionEvenementsType;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class FestivalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Festival::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Festivals')
            ->setPageTitle('new', 'Créer un festival')
            ->setPageTitle('edit', 'Modifier un festival')
            ->setPageTitle('detail', 'Détails du festival')
            ->setEntityLabelInPlural('Festivals')
            ->setEntityLabelInSingular('Festival')
            ->setPaginatorPageSize(10);
    }

    public function configureFields(string $pageName): iterable
{
    // $nbEvents = count($this->);
    $fields = [
        IdField::new('id', 'ID')->onlyOnIndex(),
        TextField::new('nom', 'Nom'),
        TextEditorField::new('description', 'Description'),
        DateTimeField::new('dateDebut', 'Date de début'),
        DateTimeField::new('dateFin', 'Date de fin'),
        CollectionField::new('evenements', 'Nombre d\'événement')
            ->formatValue(function ($value, $entity) {
                return count($entity->getEvenements());
            }),
    ];

    if (in_array($pageName, ['edit', 'detail', 'new'])){
            $fields[] = AssociationField::new('evenements', 'Événements')
                ->setFormTypeOption('disabled', true);
        }

    // if (in_array($pageName, ['edit', 'new'])) {
    //     $fields[] = AssociationField::new('evenements', 'Événements')
    //         ->setFormTypeOption('by_reference', false)
    //         ->setFormTypeOption('multiple', true);
    //     }

    return $fields;
}
}
