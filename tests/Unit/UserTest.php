<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testGetId(): void
    {
        $user = new User();
        $this->assertNull( $user->getId());
    }

    public function testGetSetEmail(): void
    {
        $user = new User();
        $email = 'test@example.com';
        $user->setEmail($email);
        $this->assertEquals($email, $user->getEmail());
    }

    public function testGetUserIdentifier(): void
    {
        $user = new User();
        $email = 'test@example.com';
        $user->setEmail($email);
        $this->assertEquals($email, $user->getUserIdentifier());
    }

    public function testGetSetRoles(): void
    {
        $user = new User();
        $roles = ['ROLE_ADMIN', 'ROLE_USER'];
        $user->setRoles($roles);
        $this->assertEquals(['ROLE_ADMIN', 'ROLE_USER'], $user->getRoles());
    }

    public function testGetSetPassword(): void
    {
        $user = new User();
        $password = 'password';
        $user->setPassword($password);
        $this->assertEquals($password, $user->getPassword());
    }

}