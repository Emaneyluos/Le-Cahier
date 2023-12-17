<?php

namespace App\Factory;

use App\Entity\Professeur;
use App\Repository\ProfesseurRepository;
use Symfony\Component\Form\FormInterface;

class ProfesseurFactory {

    /** @var ProfesseurRepository $professeurRepository */
    protected $professeurRepository;
    
    /**
     * ProfesseurFactory constructor.
     * @param ProfesseurRepository $professeurRepository
     */
    public function __construct(
        ProfesseurRepository $professeurRepository,
    ) {
        $this->professeurRepository = $professeurRepository;
    }

    /**
     * @param Professeur $professeur
     * @param FormInterface $form
     * @return Professeur
     * @throws \Exception
     */
    public function create(Professeur $professeur, FormInterface $form) {

        // Vérifier si le code n'est pas déjà utilisé
        // Vérifier si le code n'est pas déjà utilisé
        // Vérifier si le code n'est pas déjà utilisé
        // Vérifier si le code n'est pas déjà utilisé

        return $this->edit($professeur, $form);
    }

    /**
     * @param Professeur $professeur
     * @param FormInterface $form
     * @return Professeur
     * @throws \Exception
     */
    public function edit(Professeur $professeur, ?FormInterface $form)
    {
        return $professeur;
    }
}