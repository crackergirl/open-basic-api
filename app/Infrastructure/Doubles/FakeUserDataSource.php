<?php

namespace App\Infrastructure\Doubles;
use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;

class FakeUserDataSource implements UserDataSource
{
    private array $usersList = [1,2,90];

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
