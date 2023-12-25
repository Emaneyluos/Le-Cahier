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

        $allNiveau = $this->niveauRepository->findAllSortedByPosition();
        $lastposition = $allNiveau[0]->getPosition();
        $position = $niveau->getPosition();

        die();
        if ($position < 1 || $position === null) {
            $position = $lastposition + 1;
        } else {
            $entiteExistante = $this->niveauRepository->findOneBy(['position' => $position]);

            if ($entiteExistante && $entiteExistante !== $niveau) {
                $this->decalerPositions($position);
            } else {
                if ($position > $lastposition + 1) {
                    $niveau->setPosition($lastposition + 1);
                }
            }

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

        if (count($allNiveau) < $niveau->getPosition()) {
            $niveau->setPosition(count($allNiveau));
            return $niveau;
        }


        $lastposition = count($allNiveau);
        $position = $niveau->getPosition();

        $suite = [];
        foreach ($allNiveau as $niveau) {
            $suite[] = $niveau->getPosition();
        }

        $previousPosition = $this->trouverChiffreManquant($suite);

        if ($previousPosition < 1) {
            return $niveau;
        }

        if ($position < 1 || $position === null) {
            $position = $lastposition;
        } else {
           $this->decalerPositions($niveau, $previousPosition);

            // if ($entiteExistante && $entiteExistante !== $niveau) {
            //     $this->decalerPositions($position);
            // } else {
            //     if ($position > $lastposition + 1) {
            //         $niveau->setPosition($lastposition + 1);
            //     }
            // }

        }
        
        return $niveau;
    }

    public function delete(Niveau $niveau)
    {
        $this->niveauRepository->delete($niveau);
    }

    private function decalerPositions($niveau, $positionDeDepart)
    {
        $nouvellePosition = $niveau->getPosition();
        $allNiveau = $this->niveauRepository->findAll();

        if ($positionDeDepart < $nouvellePosition) {
            foreach ($allNiveau as $otherNiveau) {
                if ($otherNiveau == $niveau) {
                    continue;
                }
                if ($otherNiveau->getPosition() < $positionDeDepart && $otherNiveau->getPosition() >= $nouvellePosition) {
                    $otherNiveau->setPosition($otherNiveau->getPosition() + 1);
                    $this->niveauRepository->save($otherNiveau, true);
                }
            }



        } else {
            
            foreach ($allNiveau as $otherNiveau) {
                if ($otherNiveau == $niveau) {
                    continue;
                }
                if ($otherNiveau->getPosition() > $positionDeDepart && $otherNiveau->getPosition() <= $nouvellePosition) {
                    $otherNiveau->setPosition($otherNiveau->getPosition() - 1);
                    $this->niveauRepository->save($otherNiveau, true);
                }
            }
            
        }

        $niveau->setPosition($nouvellePosition);
    }

    function trouverChiffreManquant($suite) {
        $n = count($suite) + 1; // Taille attendue de la suite
        $sommeAttendue = ($n * ($n + 1)) / 2;
        $sommeReelle = array_sum($suite);
    
        return $sommeAttendue - $sommeReelle;
    }
}