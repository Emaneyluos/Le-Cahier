<?php

namespace App\Factory;

use App\Entity\Matiere;
use App\Repository\MatiereRepository;
use Symfony\Component\Form\FormInterface;

class MatiereFactory {

    /** @var MatiereRepository $matiereRepository */
    protected $matiereRepository;
    
    /**
     * MatiereFactory constructor.
     * @param MatiereRepository $matiereRepository
     */
    public function __construct(
        MatiereRepository $matiereRepository,
    ) {
        $this->matiereRepository = $matiereRepository;
    }

    /**
     * @param Matiere $matiere
     * @param FormInterface $form
     * @return Matiere
     * @throws \Exception
     */
    public function create(Matiere $matiere, FormInterface $form) {

        return $this->edit($matiere, $form);
    }

    /**
     * @param Matiere $matiere
     * @param FormInterface $form
     * @return Matiere
     * @throws \Exception
     */
    public function edit(Matiere $matiere, ?FormInterface $form)
    {
        return $matiere;
    }
}