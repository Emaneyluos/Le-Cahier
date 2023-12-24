<?php

namespace App\Manager;

use App\Entity\Classe;
use App\Factory\ClasseFactory;
use App\Repository\ClasseRepository;
use Symfony\Component\Form\FormInterface;

class ClasseManager {

    /** @var ClasseFactory $classeFactory */
    protected $classeFactory;

    /** @var ClasseRepository $classeRepository */
    protected $classeRepository;

    /**
     * ClasseManager constructor.
     * 
     * @param ClasseFactory $classeFactory
     * @param ClasseRepository $classeRepository
     */
    public function __construct
    (
        ClasseFactory $classeFactory,
        ClasseRepository $classeRepository
    )
    {
        $this->classeFactory = $classeFactory;
        $this->ClasseRepository = $classeRepository;
    }

    /**
     * @param Classe $classe
     * @param FormInterface|null $form
     * @return Classe
     * @throws \Exception
     */
    public function create(Classe $classe, ?FormInterface $form = null): Classe
    {
        return $this->classeFactory->create($classe, $form);
    }

    /**
     * @param Classe $classe
     * @param FormInterface|null $form
     * @return Classe
     */
    public function edit(Classe $classe, ?FormInterface $form = null):  Classe
    {
        $this->ClasseRepository->save($this->classeFactory->edit($classe, $form), true);
        return $classe;
    }

    /**
     * @param Classe $classe
     * @return Classe
     */
    public function update(Classe $classe): Classe
    {
        $this->ClasseRepository->save($classe, true);
        return $classe;
    }

    /**
     * @param Classe $classe
     * @return bool
     */
    public function delete(Classe $classe): bool
    {
        $this->classeFactory->delete($classe);
        return true;
    }
}