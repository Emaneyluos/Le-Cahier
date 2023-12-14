<?php

namespace App\Factory;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Form\FormInterface;

class UserFactory {

    /** @var UserRepository $userRepository */
    protected $userRepository;
    
    /**
     * UserFactory constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(
        UserRepository $userRepository,
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * @param User $user
     * @param FormInterface $form
     * @return User
     * @throws \Exception
     */
    public function create(User $user, FormInterface $form) {

        return $this->edit($user, $form);
    }

    /**
     * @param User $user
     * @param FormInterface $form
     * @return User
     * @throws \Exception
     */
    public function edit(User $user, ?FormInterface $form)
    {
        return $user;
    }
}