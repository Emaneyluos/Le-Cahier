<?php

namespace App\Manager;

use App\Entity\User;
use App\Factory\UserFactory;
use App\Repository\UserRepository;
use Symfony\Component\Form\FormInterface;

class UserManager {

    /** @var UserFactory $userFactory */
    protected $userFactory;

    /** @var UserRepository $userRepository */
    protected $userRepository;

    /**
     * UserManager constructor.
     * 
     * @param UserFactory $userFactory
     * @param UserRepository $userRepository
     */
    public function __construct
    (
        UserFactory $userFactory,
        UserRepository $userRepository
    )
    {
        $this->userFactory = $userFactory;
        $this->UserRepository = $userRepository;
    }

    /**
     * @param User $user
     * @param FormInterface|null $form
     * @return User
     * @throws \Exception
     */
    public function create(User $user, ?FormInterface $form = null): User
    {
        return $this->userFactory->create($user, $form);
    }

    /**
     * @param User $user
     * @param FormInterface|null $form
     * @return User
     */
    public function edit(User $user, ?FormInterface $form = null):  User
    {
        $this->UserRepository->save($this->userFactory->edit($user, $form), true);
        return $user;
    }

    /**
     * @param User $user
     * @return User
     */
    public function update(User $user): User
    {
        $this->UserRepository->save($user, true);
        return $user;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function delete(User $user): bool
    {
        $this->userFactory->delete($user);
        return true;
    }
}