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
    public function create(Niveau $niveau, ?FormInterface $form) {

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
        $allNiveau = $this->niveauRepository->findAll("position", "DESC");
        $lastposition = $allNiveau[0]->getPosition();

        $position = $niveau->getPosition();

        if ($position < 1 || $position === null) {
            $position = $lastposition + 1;
        } else {
            $entiteExistante = $this->niveauRepository->findOneBy(['position' => $position]);

            if ($entiteExistante) {
                $this->decalerPositions($position);
            } else {
                if ($position > $lastposition + 1) {
                    $niveau->setPosition($lastposition + 1);
                }
            }

        }
        
        return $niveau;
    }

    public function delete(Niveau $niveau)
    {
        $this->niveauRepository->delete($niveau);
    }

    private function decalerPositions($positionDeDepart)
    {
        $niveaux = $this->niveauRepository->findByPositionGreaterOrEqualThan($positionDeDepart);

        foreach ($niveaux as $niveau) {
            $niveau->setPosition($niveau->getPosition() + 1);
            $this->niveauRepository->save($niveau, true);
        }
    }
}