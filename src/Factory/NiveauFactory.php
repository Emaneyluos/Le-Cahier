<?php

namespace App\Factory;

use App\Entity\Niveau;
use App\Repository\NiveauRepository;
use Symfony\Component\Form\FormInterface;

class NiveauFactory
{
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
    public function create(Niveau $niveau, ?FormInterface $form)
    {

        $allNiveau = $this->niveauRepository->findAll();
        $lastposition = count($allNiveau);
        $position = $niveau->getPosition();

        if ($position < 1 || $position == null) {
            $position = $lastposition + 1;
        } elseif ($position >= $lastposition + 1) {
            $niveau->setPosition($lastposition + 1);
        } else {
            $this->niveauRepository->save($niveau, true); // Sauvegarde pour le bon déroulement de decalerPositions
            $this->decalerPositions($niveau, $lastposition + 1);
        }

        return $this->edit($niveau, $form, true);
    }

    /**
     * @param Niveau $niveau
     * @param FormInterface $form
     * @return Niveau
     * @throws \Exception
     */
    public function edit(Niveau $niveau, ?FormInterface $form, bool $create = false): Niveau
    {

        if ($create) {
            return $niveau;
        }


        $allNiveau = $this->niveauRepository->findAll();

        if (count($allNiveau) === 0) {
            return $niveau;
        }

        $lastposition = count($allNiveau);
        $position = $niveau->getPosition();

        $suite = [];
        foreach ($allNiveau as $niveauSuite) {
            if ($niveauSuite !== $niveau) {
                $suite[] = $niveauSuite->getPosition();
            }
        }

        $previousPosition = $this->trouverChiffreManquant($suite);

        if ($previousPosition < 1) {
            return $niveau;
        }

        if ($position < 1 || $position == null) {
            $niveau->setPosition($lastposition);
        } elseif (count($allNiveau) < $niveau->getPosition()) {
            $niveau->setPosition(count($allNiveau));
        }

        $this->decalerPositions($niveau, $previousPosition);

        return $niveau;
    }

    public function delete(Niveau $niveau): Niveau
    {
        $allNiveau = $this->niveauRepository->findAll();
        $positionDeDepart = $niveau->getPosition();
        $lastposition = count($allNiveau);
        $niveau->setPosition($lastposition);
        $this->decalerPositions($niveau, $positionDeDepart);
        return $niveau;
    }

    private function decalerPositions(Niveau $niveau, int $positionDeDepart): void
    {
        $nouvellePosition = $niveau->getPosition();
        $allNiveau = $this->niveauRepository->findAll();

        if ($positionDeDepart === $nouvellePosition) {
            return;
        }

        if ($positionDeDepart < $nouvellePosition) {
            foreach ($allNiveau as $otherNiveau) {
                if ($otherNiveau === $niveau) {
                    continue;
                }
                if (
                    $otherNiveau->getPosition() > $positionDeDepart
                    && $otherNiveau->getPosition() <= $nouvellePosition
                ) {
                    $otherNiveau->setPosition($otherNiveau->getPosition() - 1);
                    $this->niveauRepository->save($otherNiveau, true);
                }
            }
        } else {
            foreach ($allNiveau as $otherNiveau) {
                if ($otherNiveau == $niveau) {
                    continue;
                }
                if (
                    $otherNiveau->getPosition() < $positionDeDepart
                    && $otherNiveau->getPosition() >= $nouvellePosition
                ) {
                    $otherNiveau->setPosition($otherNiveau->getPosition() + 1);
                    $this->niveauRepository->save($otherNiveau, true);
                }
            }
        }
    }

    /**
     * @param Array<int> $suite
     * @return int
     */
    protected function trouverChiffreManquant(array $suite): int
    {
        $n = count($suite) + 1; // Taille attendue de la suite
        $sommeAttendue = ($n * ($n + 1)) / 2;
        $sommeReelle = array_sum($suite);

        return $sommeAttendue - $sommeReelle;
    }
}
