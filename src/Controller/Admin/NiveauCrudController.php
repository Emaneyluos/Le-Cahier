<?php

namespace App\Controller\Admin;

use App\Entity\Niveau;
use App\Repository\NiveauRepository;
use App\Manager\NiveauManager;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use Doctrine\ORM\EntityManagerInterface;


class NiveauCrudController extends AbstractCrudController
{

    protected $niveauRepository;

    protected $niveauManager;

    public function __construct(
        NiveauRepository $niveauRepository,
        NiveauManager $niveauManager
    ) {
        $this->niveauRepository = $niveauRepository;
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
        
        // Ici, l'entité a déjà été remplie avec les données du formulaire

        // Passer l'entité au manager pour le traitement avant la persistance
        // $this->votreManager->traiterEntiteAvantPersistence($entityInstance);

        // $managedEntity 
        // $this->updateEntity($entityManager, $entityInstance);
    }

    // public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    // {
    //     $request = $this->container->get('request_stack')->getCurrentRequest();

    //     if ($request->isMethod('POST')) {
    //         $position = $entityInstance->getPosition();
            
    //         $entiteExistante = $this->niveauRepository->findOneBy(['position' => $position]);
    //         // if ($entiteExistante) {
    //         //     var_dump($entiteExistante->getNom());

    //         //     // Décaler les positions des entités existantes
    //         //     $this->decalerPositions($positionDesiree);
    //         // } else {
    //         //     var_dump("pas d'entité existante");
    //         // }

    //         die();
            
    //     }

    //     var_dump($entityInstance->getNom());
    //     die();

    //     parent::updateEntity($entityManager, $entityInstance);
    // }
}
