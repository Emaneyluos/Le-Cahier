<?php

namespace App\Manager;

use App\Entity\Professeur;
use App\Factory\ProfesseurFactory;
use App\Repository\ProfesseurRepository;
use Symfony\Component\Form\FormInterface;

class ProfesseurManager {

    /** @var ProfesseurFactory $professeurFactory */
    protected $professeurFactory;

    /** @var ProfesseurRepository $professeurRepository */
    protected $professeurRepository;

    /**
     * ProfesseurManager constructor.
     * 
     * @param ProfesseurFactory $professeurFactory
     * @param ProfesseurRepository $professeurRepository
     */
    public function __construct
    (
        ProfesseurFactory $professeurFactory,
        ProfesseurRepository $professeurRepository
    )
    {
        $this->professeurFactory = $professeurFactory;
        $this->ProfesseurRepository = $professeurRepository;
    }

    /**
     * @param Professeur $professeur
     * @param FormInterface|null $form
     * @return Professeur
     * @throws \Exception
     */
    public function create(Professeur $professeur, ?FormInterface $form = null): Professeur
    {
        return $this->professeurFactory->create($professeur, $form);
    }

    /**
     * @param Professeur $professeur
     * @param FormInterface|null $form
     * @return Professeur
     */
    public function edit(Professeur $professeur, ?FormInterface $form = null):  Professeur
    {
        $this->ProfesseurRepository->save($this->professeurFactory->edit($professeur, $form), true);
        return $professeur;
    }

    /**
     * @param Professeur $professeur
     * @return Professeur
     */
    public function update(Professeur $professeur): Professeur
    {
        $this->ProfesseurRepository->save($professeur, true);
        return $professeur;
    }

    /**
     * @param Professeur $professeur
     * @return bool
     */
    public function delete(Professeur $professeur): bool
    {
        $this->professeurFactory->delete($professeur);
        return true;
    }
}