<?php
namespace App\Application\UserAdopter;

use App\Application\UserDataSource\UserDataSource;
use Exception;

class isUserAdopterService
{
    /**
     * @var UserDataSource
     */
    private $userDataSource;


    /**
     * IsUserAdopterService constructor.
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
    public function execute(string $id_user): bool
    {
        $user = $this->userDataSource->findById($id_user);
        $isUserAdopter = false;

        if ($user->getId() < 1000) {
            $isUserAdopter = true;
        }

        return $isUserAdopter;
    }

}
