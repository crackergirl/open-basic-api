<?php

namespace App\Infrastructure\Doubles;
use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;

class FakeUserDataSource implements UserDataSource
{

    public function findByEmail(string $email): User
    {
        // TODO: Implement findByEmail() method.
    }

    public function findById(string $id): User
    {
        $user = new User($id, 'user@user.com');
        return $user;
    }

    public function listUsers(string $state): array
    {
        if($state==="empty"){
            return [];
        }
    }
}
