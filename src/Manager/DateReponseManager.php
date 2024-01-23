<?php

namespace App\Manager;

use App\Entity\DateReponse;
use App\Factory\DateReponseFactory;
use App\Repository\DateReponseRepository;
use Symfony\Component\Form\FormInterface;

class DateReponseManager
{
    /** @var DateReponseFactory $dateReponseFactory */
    protected $dateReponseFactory;

    /** @var DateReponseRepository $dateReponseRepository */
    protected $dateReponseRepository;

    /**
     * DateReponseManager constructor.
     *
     * @param DateReponseFactory $dateReponseFactory
     * @param DateReponseRepository $dateReponseRepository
     */
    public function __construct(
        DateReponseFactory $dateReponseFactory,
        DateReponseRepository $dateReponseRepository
    ) {
        $this->dateReponseFactory = $dateReponseFactory;
        $this->DateReponseRepository = $dateReponseRepository;
    }

    /**
     * @param DateReponse $dateReponse
     * @param FormInterface|null $form
     * @return DateReponse
     * @throws \Exception
     */
    public function create(DateReponse $dateReponse, ?FormInterface $form = null): DateReponse
    {
        return $this->dateReponseFactory->create($dateReponse, $form);
    }

    /**
     * @param DateReponse $dateReponse
     * @param FormInterface|null $form
     * @return DateReponse
     */
    public function edit(DateReponse $dateReponse, ?FormInterface $form = null): DateReponse
    {
        $this->DateReponseRepository->save($this->dateReponseFactory->edit($dateReponse, $form), true);
        return $dateReponse;
    }

    /**
     * @param DateReponse $dateReponse
     * @return DateReponse
     */
    public function update(DateReponse $dateReponse): DateReponse
    {
        $this->DateReponseRepository->save($dateReponse, true);
        return $dateReponse;
    }

    /**
     * @param DateReponse $dateReponse
     * @return bool
     */
    public function delete(DateReponse $dateReponse): bool
    {
        $this->dateReponseFactory->delete($dateReponse);
        return true;
    }
}
