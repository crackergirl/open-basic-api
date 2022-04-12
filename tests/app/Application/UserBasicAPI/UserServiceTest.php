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
        $this->userDataSource
            ->expects('findById')
            ->with(9999)
            ->once()
            ->andThrow(new Exception('User not found'));

        $this->expectException(Exception::class);

        $this->userService->execute(9999);
    }

    /**
     * @test
     */
    public function userFound()
    {
        $user = new User(300, 'not_early_adopter@email.com');

        $this->userDataSource
            ->expects('findById')
            ->with(300)
            ->once()
            ->andReturn($user);

        $isUserInUserAdopter = $this->userService->execute(300);

        $this->assertEquals($user,$isUserInUserAdopter);
    }
}
