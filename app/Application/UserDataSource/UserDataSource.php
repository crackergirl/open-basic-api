<?php

namespace App\Application\UserDataSource;

use App\Domain\User;

Interface UserDataSource
{
    public function findByEmail(string $email): User;

    public function findById(string $id):bool;

    public function listUsers(string $state): array;
}
