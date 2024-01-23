<?php

namespace App\Factory;

use App\Entity\Classe;
use App\Repository\ClasseRepository;
use Symfony\Component\Form\FormInterface;

class ClasseFactory
{
    /** @var ClasseRepository $classeRepository */
    protected $classeRepository;

    /**
     * ClasseFactory constructor.
     * @param ClasseRepository $classeRepository
     */
    public function __construct(
        ClasseRepository $classeRepository,
    ) {
        $this->classeRepository = $classeRepository;
    }

    /**
     * @param Classe $classe
     * @param FormInterface $form
     * @return Classe
     * @throws \Exception
     */
    public function create(Classe $classe, FormInterface $form)
    {

        return $this->edit($classe, $form);
    }

    /**
     * @param Classe $classe
     * @param FormInterface $form
     * @return Classe
     * @throws \Exception
     */
    public function edit(Classe $classe, ?FormInterface $form)
    {
        return $classe;
    }

    public function delete(Classe $classe)
    {
        $this->classeRepository->delete($classe);
    }
}
