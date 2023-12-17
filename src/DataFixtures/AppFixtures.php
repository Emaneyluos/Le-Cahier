<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Classe;
use App\Entity\Niveau;
use App\Entity\Matiere;
use App\Entity\Professeur;
use App\Entity\Question;
use App\Entity\DateReponse;
use Doctrine\ORM\EntityManagerInterface; // Import the EntityManagerInterface class


class AppFixtures extends Fixture
{
    private $entityManager; // Create a private property

    public function __construct(EntityManagerInterface $entityManager) // Add the constructor
    {
        $this->entityManager = $entityManager;
    }
    
    public function load(ObjectManager $manager): void
    {

        $niveau6 = new Niveau();
        $niveau6
            ->setNom('6ème')
            ->setPosition(1);
        $manager->persist($niveau6);
        $niveau5 = new Niveau();
        $niveau5
            ->setNom('5ème')
            ->setPosition(2);
        $manager->persist($niveau5);
        $niveau4 = new Niveau();
        $niveau4
            ->setNom('4ème')
            ->setPosition(3);
        $manager->persist($niveau4);
        $niveau3 = new Niveau();
        $niveau3
            ->setNom('3ème')
            ->setPosition(4);
        $manager->persist($niveau3);


        $classes = [];

        $classe6A = new Classe();
        $classe6A->setNom('6ème A');
        $classe6A->setNiveau($niveau6);
        $classes[] = $classe6A;

        $classe6B = new Classe();
        $classe6B->setNom('6ème B');
        $classe6B->setNiveau($niveau6);
        $classes[] = $classe6B;

        $classe6C = new Classe();
        $classe6C->setNom('6ème C');
        $classe6C->setNiveau($niveau6);
        $classes[] = $classe6C;

        $classe6D = new Classe();
        $classe6D->setNom('6ème D');
        $classe6D->setNiveau($niveau6);
        $classes[] = $classe6D;

        $classe5A = new Classe();
        $classe5A->setNom('5ème A');
        $classe5A->setNiveau($niveau5);
        $classes[] = $classe5A;


        $classe5B = new Classe();
        $classe5B->setNom('5ème B');
        $classe5B->setNiveau($niveau5);
        $classes[] = $classe5B;

        $classe5C = new Classe();
        $classe5C->setNom('5ème C');
        $classe5C->setNiveau($niveau5);
        $classes[] = $classe5C;

        $classe5D = new Classe();
        $classe5D->setNom('5ème D');
        $classe5D->setNiveau($niveau5);
        $classes[] = $classe5D;

        $classe4A = new Classe();
        $classe4A->setNom('4ème A');
        $classe4A->setNiveau($niveau4);
        $classes[] = $classe4A;

        $classe4B = new Classe();
        $classe4B->setNom('4ème B');
        $classe4B->setNiveau($niveau4);
        $classes[] = $classe4B;

        $classe4C = new Classe();
        $classe4C->setNom('4ème C');
        $classe4C->setNiveau($niveau4);
        $classes[] = $classe4C;

        $classe4D = new Classe();
        $classe4D->setNom('4ème D');
        $classe4D->setNiveau($niveau4);
        $classes[] = $classe4D;

        $classe3A = new Classe();
        $classe3A->setNom('3ème A');
        $classe3A->setNiveau($niveau3);
        $classes[] = $classe3A;

        $classe3B = new Classe();
        $classe3B->setNom('3ème B');
        $classe3B->setNiveau($niveau3);
        $classes[] = $classe3B;

        $classe3C = new Classe();
        $classe3C->setNom('3ème C');
        $classe3C->setNiveau($niveau3);
        $classes[] = $classe3C;

        $classe3D = new Classe();
        $classe3D->setNom('3ème D');
        $classe3D->setNiveau($niveau3);
        $classes[] = $classe3D;

        foreach ($classes as $classe) {
            $manager->persist($classe);
        }


        $maths = new Matiere();
        $maths->setNom('Mathématiques');
        $manager->persist($maths);

        $histoire = new Matiere();
        $histoire->setNom('Histoire');
        $manager->persist($histoire);

        $geographie = new Matiere();
        $geographie->setNom('Géographie');
        $manager->persist($geographie);

        $sciences = new Matiere();
        $sciences->setNom('Sciences');
        $manager->persist($sciences);

        $francais = new Matiere();
        $francais->setNom('Français');
        $manager->persist($francais);

        $anglais = new Matiere();
        $anglais->setNom('Anglais');
        $manager->persist($anglais);

        
        $profMaths = new Professeur();
        $profMaths
            ->setNom('Mr. Dupont')
            ->setCode(123456)
            ->setMatiere($maths);
        $manager->persist($profMaths);

        $profHistoire = new Professeur();
        $profHistoire
            ->setNom('Ms. Durand')
            ->setCode(123456)
            ->setMatiere($histoire);
        $manager->persist($profHistoire);
        
        $profGeographie = new Professeur();
        $profGeographie
            ->setNom('Mme. Martin')
            ->setCode(123456)
            ->setMatiere($geographie);
        $manager->persist($profGeographie);

        $profSciences = new Professeur();
        $profSciences
            ->setNom('Mr. Lefevre')
            ->setCode(123456)
            ->setMatiere($sciences);
        $manager->persist($profSciences);

        $profFrancais = new Professeur();
        $profFrancais
            ->setNom('Mme. Dubois')
            ->setCode(123456)
            ->setMatiere($francais);
        $manager->persist($profFrancais);

        $profAnglais = new Professeur();
        $profAnglais
            ->setNom('Mr. Smith')
            ->setCode(123456)
            ->setMatiere($anglais);
        $manager->persist($profAnglais);       

        $professeursParMatiere = [
            $maths->getNom() => $profMaths,
            $histoire->getNom() => $profHistoire,
            $geographie->getNom() => $profGeographie,
            $sciences->getNom() => $profSciences,
            $francais->getNom() => $profFrancais,
            $anglais->getNom() => $profAnglais,
        ];
    
        // Create questions for each class and subject
        foreach ($classes as $classe) {
            foreach ([$maths, $histoire, $geographie, $sciences, $francais, $anglais] as $matiere) {
                $question = new Question();
                $professeur = $professeursParMatiere[$matiere->getNom()];
                $dateAleatoireCreation = new \DateTime();
                $dateAleatoireCreation->setTimestamp(rand(strtotime("-1 year"), strtotime('today')));
                $dateAleatoireValidite = new \DateTime();
                $dateAleatoireValidite->setTimestamp(rand(strtotime('today'), strtotime('+1 year')));

                $question
                    ->setClasse($classe)
                    ->setProfesseur($professeur)
                    ->setMatiere($matiere)
                    ->setSignalement(false)
                    ->setVisible(true)
                    ->setCreeeLe($dateAleatoireCreation);

                if (rand(0, 1) === 0) {
                    $question->setDateValidite($dateAleatoireValidite);
                }

                if ($matiere === $maths) {
                    $question
                        ->setQuestion('Quelle est la racine carrée de 4 ?')
                        ->setReponse('2');
                }
                elseif ($matiere === $histoire) {
                    $question
                        ->setQuestion('Quand a eu lieu la révolution française ?')
                        ->setReponse('1789');
                }
                elseif ($matiere === $geographie) {
                    $question
                        ->setQuestion('Quelle est la capitale de la France ?')
                        ->setReponse('Paris');
                }
                elseif ($matiere === $sciences) {
                    $question
                        ->setQuestion('Quel est le symbole de l\'eau ?')
                        ->setReponse('H2O');
                }
                elseif ($matiere === $francais) {
                    $question
                        ->setQuestion('Quel est le pluriel de "cheval" ?')
                        ->setReponse('chevaux');
                }
                elseif ($matiere === $anglais) {
                    $question
                        ->setQuestion('Comment dit-on "bonjour" en anglais ?')
                        ->setReponse('hello');
                }

                for ($i = 0; $i < rand(0, 5); $i++) {
                    $dateReponse = new DateReponse();

                    $randomDate = new \DateTime();
                    $randomDate->setTimestamp(rand($question->getCreeeLe()->getTimestamp(), strtotime('-1 day')));

                    $dateReponse->setDate(new \DateTime('tomorrow'));
                    $dateReponse->setEstCorrect(rand(0, 1) === 0);
                    $manager->persist($dateReponse);
                    $question->addDateReponse($dateReponse);
                }

                $manager->persist($question);

            }
        }

        $manager->flush();
    }
}
