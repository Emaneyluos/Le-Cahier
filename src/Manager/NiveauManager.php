<?php

namespace App\Manager;

use App\Entity\Niveau;
use App\Factory\NiveauFactory;
use App\Repository\niveauRepository;
use Symfony\Component\Form\FormInterface;
use Doctrine\ORM\EntityManagerInterface;

class NiveauManager {

    /** @var NiveauFactory $niveauFactory */
    protected $niveauFactory;

    /** @var niveauRepository $niveauRepository */
    protected $niveauRepository;

    protected $entityManager;

    /**
     * NiveauManager constructor.
     * 
     * @param NiveauFactory $niveauFactory
     * @param niveauRepository $niveauRepository
     */
    public function __construct
    (
        NiveauFactory $niveauFactory,
        niveauRepository $niveauRepository,
        EntityManagerInterface $entityManager
    )
    {
        $this->niveauFactory = $niveauFactory;
        $this->niveauRepository = $niveauRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param Niveau $niveau
     * @param FormInterface|null $form
     * @return Niveau
     * @throws \Exception
     */
    public function create(Niveau $niveau, ?FormInterface $form = null): Niveau
    {
        return $this->niveauFactory->create($niveau, $form);
    }

    /**
     * @param Niveau $niveau
     * @param FormInterface|null $form
     * @return Niveau
     */
    public function edit(Niveau $niveau, ?FormInterface $form = null):  Niveau
    {
        $this->niveauRepository->save($this->niveauFactory->edit($niveau, $form), true);
        return $niveau;
    }

    /**
     * @param Niveau $niveau
     * @return Niveau
     */
    public function update(Niveau $niveau): Niveau
    {
        $position = $niveau->getPosition();
        $entiteExistante = $this->niveauRepository->findOneBy(['position' => $position]);

        if ($entiteExistante) {
            $this->decalerPositions($position);
        }


        $this->niveauRepository->save($niveau, true);
        return $niveau;
    }

    /**
     * @param Niveau $niveau
     * @return bool
     */
    public function delete(Niveau $niveau): bool
    {
        $this->niveauFactory->delete($niveau);
        return true;
    }

    private function decalerPositions($positionDeDepart)
    {
        $niveaux = $this->niveauRepository->findByPositionGreaterOrEqualThan($positionDeDepart);

        foreach ($niveaux as $niveau) {
            $niveau->setPosition($niveau->getPosition() + 1);
            $this->entityManager->persist($niveau);
        }

        $this->entityManager->flush();
    }
}