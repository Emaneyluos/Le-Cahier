<?php

namespace App\Controller\Admin;

use App\Entity\Niveau;
use App\Manager\NiveauManager;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class NiveauCrudController extends AbstractCrudController
{
    protected NiveauManager $niveauManager;

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

    //Configurer le tri d'affichage
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['position' => 'ASC']);
    }


    /**
     * @param EntityManagerInterface $entityManager
     * @param Niveau $entityInstance
     * @return void
     */
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->niveauManager->create($entityInstance);
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @param Niveau $entityInstance
     * @return void
     */
    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->niveauManager->edit($entityInstance);
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @param Niveau $entityInstance
     * @return void
     */
    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->niveauManager->delete($entityInstance);
    }
}
