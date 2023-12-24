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
        $request = $this->container->get('request_stack')->getCurrentRequest();

        if ($request->isMethod('POST')) {
            $position = $entityInstance->getPosition();
            
            $entiteExistante = $this->niveauRepository->findOneBy(['position' => $position]);
            // if ($entiteExistante) {
            //     var_dump($entiteExistante->getNom());

            //     // Décaler les positions des entités existantes
            //     $this->decalerPositions($positionDesiree);
            // } else {
            //     var_dump("pas d'entité existante");
            // }

            die();
            
        }

        var_dump($entityInstance->getNom());
        die();

        parent::updateEntity($entityManager, $entityInstance);
    }
}
