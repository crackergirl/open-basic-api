<?php

namespace App\Application\UserBasicAPI;

use App\Application\UserDataSource\UserDataSource;
use Exception;

class userListService
{
    private UserDataSource $userDataSource;

    public function __construct(UserDataSource $userDataSource)
    {
        $this->userDataSource = $userDataSource;
    }

    /**
     * @throws Exception
     */
    public function execute(): array
    {
        return $this->userDataSource->listUsers();
    }
}
