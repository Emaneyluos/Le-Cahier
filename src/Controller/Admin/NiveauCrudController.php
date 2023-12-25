<?php

namespace App\Controller\Admin;

use App\Entity\Niveau;
use App\Manager\NiveauManager;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use Doctrine\ORM\EntityManagerInterface;


class NiveauCrudController extends AbstractCrudController
{


    protected $niveauManager;

    public function __construct(
        NiveauManager $niveauManager
    ) {
        $this->niveauManager = $niveauManager;
    }

    public static function getEntityFqcn(): string
    {
        return Niveau::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            IdField::new('position'),
        ];
    }


    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    { 
        $managedEntity = $this->niveauManager->create($entityInstance);
        parent::persistEntity($entityManager, $managedEntity);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $allNiveau = $this->niveauManager->edit($entityInstance);
        foreach ($allNiveau as $key => $value) {
            $stringArray [] = $value->getNom() . " - " . $value->getPosition() . " ||| ";
        }
        var_dump($stringArray);
        var_dump(count($allNiveau));
        die();
        $this->niveauManager->edit($entityInstance);
        // parent::updateEntity($entityManager, $entityInstance);
    }
}
