<?php

namespace App\Factory;

use App\Entity\Question;
use App\Repository\QuestionRepository;
use Symfony\Component\Form\FormInterface;

class QuestionFactory {

    /** @var QuestionRepository $questionRepository */
    protected $questionRepository;
    
    /**
     * QuestionFactory constructor.
     * @param QuestionRepository $questionRepository
     */
    public function __construct(
        QuestionRepository $questionRepository,
    ) {
        $this->questionRepository = $questionRepository;
    }

    /**
     * @param Question $question
     * @param FormInterface $form
     * @return Question
     * @throws \Exception
     */
    public function create(Question $question, FormInterface $form) {

        $today = new \DateTime();

        $question->setCreeeLe($today);
        $question->setSignalement(false);
        
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
}