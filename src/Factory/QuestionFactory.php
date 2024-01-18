<?php

namespace App\Factory;

use App\Entity\Question;
use App\Entity\Professeur;
use App\Repository\QuestionRepository;
use App\Repository\ProfesseurRepository;
use Symfony\Component\Form\FormInterface;

class QuestionFactory {

    /** @var QuestionRepository $questionRepository */
    protected $questionRepository;

    protected $professeurRepository;
    
    /**
     * QuestionFactory constructor.
     * @param QuestionRepository $questionRepository
     */
    public function __construct(
        QuestionRepository $questionRepository,
        ProfesseurRepository $professeurRepository,
    ) {
        $this->questionRepository = $questionRepository;
        $this->professeurRepository = $professeurRepository;
    }

    /**
     * @param Question $question
     * @param FormInterface $form
     * @return Question
     * @throws \Exception
     */
    public function create(Question $question, FormInterface $form) {

        $today = new \DateTime();
        // $today->setDate('today') 

        $question->setCreeeLe($today);
        $question->setSignalement(false);
        $question->setVisible(true);

        $professeur = $this->professeurRepository->findOneBy(['code' => $form->get("codeProfesseur")->getData()]);
        $question->setProfesseur($professeur);
        $question->setMatiere($professeur->getMatiere());
        
        return $this->edit($question, $form);
    }

    /**
     * @param Question $question
     * @param FormInterface $form
     * @return Question
     * @throws \Exception
     */
    public function edit(Question $question, ?FormInterface $form)
    {
        $today = new \DateTime();
        $question->setModifieLe($today);

        return $question;
    }

    public function delete(Question $question)
    {
        $this->questionRepository->delete($question);
    }
}