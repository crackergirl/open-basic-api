<?php
namespace App\Application\UserBasicAPI;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;

class userService
{
    private UserDataSource $userDataSource;

    public function __construct(UserDataSource $userDataSource)
    {
        $this->userDataSource = $userDataSource;
    }

    /**
     * @param string $id_user
     * @return User
     */
    public function execute(string $id_user): User
    {
        return $this->userDataSource->findById($id_user);
    }
}
