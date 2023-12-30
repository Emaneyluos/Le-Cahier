<?php

namespace App\Manager;

use App\Entity\Question;
use App\Factory\QuestionFactory;
use App\Repository\QuestionRepository;
use Symfony\Component\Form\FormInterface;

class QuestionManager {

    /** @var QuestionFactory $questionFactory */
    protected $questionFactory;

    /** @var QuestionRepository $questionRepository */
    protected $questionRepository;

    /**
     * QuestionManager constructor.
     * 
     * @param QuestionFactory $questionFactory
     * @param QuestionRepository $questionRepository
     */
    public function __construct
    (
        QuestionFactory $questionFactory,
        QuestionRepository $questionRepository
    )
    {
        $this->questionFactory = $questionFactory;
        $this->questionRepository = $questionRepository;
    }

    /**
     * @param Question $question
     * @param FormInterface|null $form
     * @return Question
     * @throws \Exception
     */
    public function create(Question $question, ?FormInterface $form = null): Question
    {
        $createdQuestion = $this->questionFactory->create($question, $form);
        $this->questionRepository->save($createdQuestion, true);
        return $createdQuestion;
    }

    /**
     * @param Question $question
     * @param FormInterface|null $form
     * @return Question
     */
    public function edit(Question $question, ?FormInterface $form = null):  Question
    {
        $this->questionRepository->save($this->questionFactory->edit($question, $form), true);
        return $question;
    }

    /**
     * @param Question $question
     * @return bool
     */
    public function delete(Question $question): bool
    {
        $this->questionFactory->delete($question);
        return true;
    }
}