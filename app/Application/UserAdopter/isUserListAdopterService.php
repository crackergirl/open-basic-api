<?php

namespace App\Application\UserAdopter;

use App\Application\UserDataSource\UserDataSource;
use Exception;

class isUserListAdopterService
{
    /**
     * @var UserDataSource
     */
    private $userDataSource;


    /**
     * IsUserListAdopterService constructor.
     * @param UserDataSource $userDataSource
     */
    public function __construct(UserDataSource $userDataSource)
    {
        $this->userDataSource = $userDataSource;
    }

    /**
     * @param string $id_user
     * @return bool
     * @throws Exception
     */
    public function execute(): array
    {
        return $this->userDataSource->listUsers();
    }

}
