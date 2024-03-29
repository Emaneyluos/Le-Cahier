<?php

namespace App\Manager;

use App\Entity\Niveau;
use App\Factory\NiveauFactory;
use App\Repository\NiveauRepository;
use Symfony\Component\Form\FormInterface;
use Doctrine\ORM\EntityManagerInterface;

class NiveauManager
{
    /** @var NiveauFactory $niveauFactory */
    protected NiveauFactory $niveauFactory;

    /** @var NiveauRepository $niveauRepository */
    protected NiveauRepository $niveauRepository;

    protected EntityManagerInterface $entityManager;

    /**
     * NiveauManager constructor.
     *
     * @param NiveauFactory $niveauFactory
     * @param NiveauRepository $niveauRepository
     */
    public function __construct(
        NiveauFactory $niveauFactory,
        niveauRepository $niveauRepository,
        EntityManagerInterface $entityManager
    ) {
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
        $this->niveauRepository->save($this->niveauFactory->create($niveau, $form), true);
        return $this->niveauFactory->create($niveau, $form);
    }

    /**
     * @param Niveau $niveau
     * @param FormInterface|null $form
     * @return Niveau
     */
    public function edit(Niveau $niveau, ?FormInterface $form = null)//: Niveau
    {
        $this->niveauRepository->save($this->niveauFactory->edit($niveau, $form), true);
        return $niveau;
    }

    /**
     * @param Niveau $niveau
     * @return bool
     */
    public function delete(Niveau $niveau): bool
    {
        $this->niveauRepository->delete($this->niveauFactory->delete($niveau), true);
        return true;
    }
}
