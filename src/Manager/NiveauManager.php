<?php

namespace App\Manager;

use App\Entity\Niveau;
use App\Factory\NiveauFactory;
use App\Repository\NiveauRepository;
use Symfony\Component\Form\FormInterface;

class NiveauManager {

    /** @var NiveauFactory $niveauFactory */
    protected $niveauFactory;

    /** @var NiveauRepository $niveauRepository */
    protected $niveauRepository;

    /**
     * NiveauManager constructor.
     * 
     * @param NiveauFactory $niveauFactory
     * @param NiveauRepository $niveauRepository
     */
    public function __construct
    (
        NiveauFactory $niveauFactory,
        NiveauRepository $niveauRepository
    )
    {
        $this->niveauFactory = $niveauFactory;
        $this->NiveauRepository = $niveauRepository;
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
        $this->NiveauRepository->save($this->niveauFactory->edit($niveau, $form), true);
        return $niveau;
    }

    /**
     * @param Niveau $niveau
     * @return Niveau
     */
    public function update(Niveau $niveau): Niveau
    {
        $this->NiveauRepository->save($niveau, true);
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
}