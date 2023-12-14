<?php

namespace App\Factory;

use App\Entity\Niveau;
use App\Repository\NiveauRepository;
use Symfony\Component\Form\FormInterface;

class NiveauFactory {

    /** @var NiveauRepository $niveauRepository */
    protected $niveauRepository;
    
    /**
     * NiveauFactory constructor.
     * @param NiveauRepository $niveauRepository
     */
    public function __construct(
        NiveauRepository $niveauRepository,
    ) {
        $this->niveauRepository = $niveauRepository;
    }

    /**
     * @param Niveau $niveau
     * @param FormInterface $form
     * @return Niveau
     * @throws \Exception
     */
    public function create(Niveau $niveau, FormInterface $form) {

        return $this->edit($niveau, $form);
    }

    /**
     * @param Niveau $niveau
     * @param FormInterface $form
     * @return Niveau
     * @throws \Exception
     */
    public function edit(Niveau $niveau, ?FormInterface $form)
    {
        return $niveau;
    }
}