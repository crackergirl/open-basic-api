<?php

namespace App\Application\UserDataSource;

use App\Domain\User;

Interface UserDataSource
{

    public function findById(string $id): User;

    public function listUsers(): array;
}
