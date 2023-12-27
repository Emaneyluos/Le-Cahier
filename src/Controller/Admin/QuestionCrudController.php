<?php

namespace App\Controller\Admin;

use App\Entity\Question;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

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
            AssociationField::new('professeur')
                ->setFormTypeOptions(['disabled' => true])
                ->setDefaultColumns('col-md-6 col-xxl-5'),
            DateTimeField::new('creeeLe')->setFormTypeOptions(['disabled' => true]),
            DateTimeField::new('modifieLe')
                ->setFormTypeOptions(['disabled' => true])
                ->hideOnIndex(),
            BooleanField::new('visible'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setSearchFields(['question', 'classe.nom', 'matiere.nom', 'professeur.nom']);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::NEW);
    }
}
