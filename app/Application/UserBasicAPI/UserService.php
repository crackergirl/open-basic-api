<?php
namespace App\Application\UserBasicAPI;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Exception;

class userService
{
    private UserDataSource $userDataSource;

    public function __construct(UserDataSource $userDataSource)
    {
        $this->userDataSource = $userDataSource;
    }

    /**
     * @throws Exception
     */
    public function execute(string $id_user): User
    {
        return $this->userDataSource->findById($id_user);
    }

}
