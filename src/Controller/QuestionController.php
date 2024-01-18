<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Professeur;
use App\Form\QuestionType;
use Doctrine\ORM\EntityManagerInterface; // Import the EntityManagerInterface class
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Manager\QuestionManager;

class QuestionController extends AbstractController
{
    protected $questionManager;
    
    
    public function __construct(QuestionManager $questionManager)
    {
        $this->questionManager = $questionManager;
    }

    #[Route('/question/new', name: 'question_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $question = new Question();
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $code = $form->get("codeProfesseur")->getData();
            $professeur = $entityManager->getRepository(Professeur::class)->findOneBy(['code' => $code]);
            if ($professeur == null) {
                $this->addFlash('error', 'Code incorrect');
                return $this->render('question/new.html.twig', [
                    'question' => $question,
                    'form' => $form->createView(),
                ]);
            }

            if (!$professeur->hasClasse($question->getClasse())) {
                $this->addFlash('error', 'Ce professeur ne donne pas cours à cette classe');
                return $this->render('question/new.html.twig', [
                    'question' => $question,
                    'form' => $form->createView(),
                ]);
            }
            
            if ($question->getDateValidite() != null && $question->getDateValidite() < new \DateTime()) {
                $this->addFlash('error', 'La date de validité doit être supérieure à la date du jour');
                return $this->render('question/new.html.twig', [
                    'question' => $question,
                    'form' => $form->createView(),
                ]);
            }

            $question->setClasse($question->getClasse());

            $this->questionManager->create($question,$form);

            $this->addFlash('success', 'Question ajoutée avec succès');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('question/new.html.twig', [
            'question' => $question,
            'form' => $form->createView(),
        ]);
    }
}