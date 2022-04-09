<?php

namespace App\Application\EarlyAdopter;

use App\Application\UserDataSource\UserDataSource;
use Exception;
use Illuminate\Http\Response;

class IsEarlyAdopterService
{
    /**
     * @var UserDataSource
     */
    private $userDataSource;

    /**
     * IsEarlyAdopterService constructor.
     * @param UserDataSource $userDataSource
     */
    public function __construct(UserDataSource $userDataSource)
    {
        $this->userDataSource = $userDataSource;
    }

    /**
     * @param string $email
     * @return bool
     * @throws Exception
     */
    public function execute(string $email): bool
    {
        $user = $this->userDataSource->findByEmail($email);
        $isEarlyAdopter = false;

        if ($user->getId() < 1000) {
            $isEarlyAdopter = true;
        }

        return $isEarlyAdopter;
    }


    public function login(string $id): bool
    {
        if($this->userDataSource->findById($id)){
            return true;
        }
       return false;
    }

    public function listUsers(string $state): array
    {
        return $this->userDataSource->listUsers($state);
    }


}
