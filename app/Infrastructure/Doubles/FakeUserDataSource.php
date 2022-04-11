<?php

namespace App\Infrastructure\Doubles;
use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;

class FakeUserDataSource implements UserDataSource
{
    private array $usersList = [];

    public function findByEmail(string $email): User
    {
        // TODO: Implement findByEmail() method.
    }

    public function findById(string $id): User
    {
        $user = new User($id, 'user@user.com');
        return $user;
    }

    public function listUsers(): array
    {
        return $this->usersList;
    }

}
