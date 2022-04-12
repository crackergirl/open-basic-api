<?php

namespace Tests\app\Application\UserBasicAPI;

use App\Application\UserBasicAPI\UserService;
use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use PHPUnit\Framework\TestCase;
use Exception;
use Mockery;

class userServiceTest extends TestCase
{
    private UserService $userService;
    private UserDataSource $userDataSource;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userDataSource = Mockery::mock(UserDataSource::class);

        $this->userService = new UserService($this->userDataSource);
    }

    /**
     * @test
     */
    public function userNotFound()
    {
        $idUser = 9999;

        $this->userDataSource
            ->expects('findById')
            ->with($idUser)
            ->once()
            ->andThrow(new Exception('User not found'));

        $this->expectException(Exception::class);

        $this->userService->execute($idUser);
    }

    /**
     * @test
     */
    public function userFound()
    {
        $email = 'not_early_adopter@email.com';
        $idUser = 300;
        $user = new User($idUser, $email);

        $this->userDataSource
            ->expects('findById')
            ->with($idUser)
            ->once()
            ->andReturn($user);

        $isUserInUserAdopter = $this->userService->execute($idUser);

        $this->assertEquals($user,$isUserInUserAdopter);
    }
}
