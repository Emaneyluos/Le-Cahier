<?php

namespace App\Manager;

use App\Entity\Matiere;
use App\Factory\MatiereFactory;
use App\Repository\MatiereRepository;
use Symfony\Component\Form\FormInterface;

class MatiereManager
{
    /** @var MatiereFactory $matiereFactory */
    protected $matiereFactory;

    /** @var MatiereRepository $matiereRepository */
    protected $matiereRepository;

    /**
     * MatiereManager constructor.
     *
     * @param MatiereFactory $matiereFactory
     * @param MatiereRepository $matiereRepository
     */
    public function __construct(
        MatiereFactory $matiereFactory,
        MatiereRepository $matiereRepository
    ) {
        $this->matiereFactory = $matiereFactory;
        $this->matiereRepository = $matiereRepository;
    }

    /**
     * @param Matiere $matiere
     * @param FormInterface|null $form
     * @return Matiere
     * @throws \Exception
     */
    public function create(Matiere $matiere, ?FormInterface $form = null): Matiere
    {
        return $this->matiereFactory->create($matiere, $form);
    }

    /**
     * @param Matiere $matiere
     * @param FormInterface|null $form
     * @return Matiere
     */
    public function edit(Matiere $matiere, ?FormInterface $form = null): Matiere
    {
        $this->matiereRepository->save($this->matiereFactory->edit($matiere, $form), true);
        return $matiere;
    }

    /**
     * @param Matiere $matiere
     * @return Matiere
     */
    public function update(Matiere $matiere): Matiere
    {
        $this->matiereRepository->save($matiere, true);
        return $matiere;
    }

    /**
     * @param Matiere $matiere
     * @return bool
     */
    public function delete(Matiere $matiere): bool
    {
        $this->matiereFactory->delete($matiere);
        return true;
    }
}
