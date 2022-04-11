<?php

namespace Tests\app\Application\UserAdopter;

use App\Application\UserAdopter\IsUserAdopterService;
use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use PHPUnit\Framework\TestCase;
use Exception;
use Mockery;

class isUserAdopterServiceTest extends TestCase
{
    private IsUserAdopterService $isUserAdopterService;
    private UserDataSource $userDataSource;
    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userDataSource = Mockery::mock(UserDataSource::class);

        $this->isUserAdopterService = new IsUserAdopterService($this->userDataSource);
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

        $this->isUserAdopterService->execute($idUser);
    }

    /**
     * @test
     */
    public function userIsNotUserAdopter()
    {
        $idUser = 9999;
        $email = 'not_user_adopter@email.com';

        $user = new User($idUser, $email);

        $this->userDataSource
            ->expects('findById')
            ->with($idUser)
            ->once()
            ->andReturn($user);

        $isUserInUserAdopter = $this->isUserAdopterService->execute($idUser);

        $this->assertFalse($isUserInUserAdopter);
    }

    /**
     * @test
     */
    public function userIsAnUserAdopter()
    {
        $email = 'not_early_adopter@email.com';
        $idUser = 300;
        $user = new User($idUser, $email);

        $this->userDataSource
            ->expects('findById')
            ->with($idUser)
            ->once()
            ->andReturn($user);

        $isUserInUserAdopter = $this->isUserAdopterService->execute($idUser);

        $this->assertTrue($isUserInUserAdopter);
    }
}
