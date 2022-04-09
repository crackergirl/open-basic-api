<?php

namespace Tests\app\Doubles;
use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;

class FakeUserDataSource implements UserDataSource
{

    public function findByEmail(string $email): User
    {
        // TODO: Implement findByEmail() method.
    }

    public function findById(string $id): bool
    {
        return $id != "999";
    }

    public function listUsers(string $state): array
    {
        if($state==="empty"){
            return [];
        }
    }
}
