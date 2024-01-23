<?php

namespace App\Factory;

use App\Entity\DateReponse;
use App\Repository\DateReponseRepository;
use Symfony\Component\Form\FormInterface;

class DateReponseFactory
{
    /** @var DateReponseRepository $dateReponseRepository */
    protected $dateReponseRepository;

    /**
     * DateReponseFactory constructor.
     * @param DateReponseRepository $dateReponseRepository
     */
    public function __construct(
        DateReponseRepository $dateReponseRepository,
    ) {
        $this->dateReponseRepository = $dateReponseRepository;
    }

    /**
     * @param DateReponse $dateReponse
     * @param FormInterface $form
     * @return DateReponse
     * @throws \Exception
     */
    public function create(DateReponse $dateReponse, FormInterface $form): DateReponse
    {

        return $this->edit($dateReponse, $form);
    }

    /**
     * @param DateReponse $dateReponse
     * @param FormInterface $form
     * @return DateReponse
     * @throws \Exception
     */
    public function edit(DateReponse $dateReponse, ?FormInterface $form): DateReponse
    {
        return $dateReponse;
    }

    public function delete(DateReponse $dateReponse): void
    {
        $this->dateReponseRepository->delete($dateReponse);
    }
}
