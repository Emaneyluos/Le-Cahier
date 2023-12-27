<?php

namespace App\Controller\Admin;

use App\Entity\Professeur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProfesseurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Professeur::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            AssociationField::new('matiere'),
            IdField::new('code')->hideOnIndex(),   
        ];
    }
}
