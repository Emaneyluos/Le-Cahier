<?php

namespace App\Controller\Admin;

use App\Entity\Question;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class QuestionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Question::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('question'),
            TextField::new('reponse')->hideOnIndex(),
            TextField::new('classe')->setFormTypeOptions(['disabled' => true]),
            TextField::new('matiere')->setFormTypeOptions(['disabled' => true]),
            AssociationField::new('professeur')->setFormTypeOptions(['disabled' => true]),
            DateTimeField::new('creeeLe'),
            BooleanField::new('visible'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // ... autres configurations
            ->setSearchFields(['question', 'classe.nom', 'matiere.nom', 'professeur.nom']);
    }
}
