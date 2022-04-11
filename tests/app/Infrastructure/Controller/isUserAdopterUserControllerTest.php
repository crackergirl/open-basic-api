<?php

namespace Tests\app\Infrastructure\Controller;

use App\Domain\User;
use Tests\TestCase;
use App\Application\UserDataSource\UserDataSource;
use Exception;
use Illuminate\Http\Response;
use Mockery;

class isUserAdopterUserControllerTest extends TestCase
{
    private UserDataSource $userDataSource;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userDataSource = Mockery::mock(UserDataSource::class);
        $this->app->bind(UserDataSource::class, fn () => $this->userDataSource);
    }

    /**
     * @test
     */
    public function genericError()
    {
        $idUser = 300;
        $this->userDataSource
            ->expects('findById')
            ->with($idUser)
            ->once()
            ->andThrow(new Exception('There was an error in the request'));

        $response = $this->get('/api/users/300');

        $response->assertStatus(Response::HTTP_BAD_REQUEST)->assertExactJson(['error' => 'There was an error in the request']);
    }

    /**
     * @test
     */
    public function userWithGivenIdDoesNotExist()
    {
        $idUser = 9999;
        $user = new User($idUser, 'user@user.com');
        $this->userDataSource
            ->expects('findById')
            ->with($idUser)
            ->once()
            ->andReturn($user);

        $response = $this->get('/api/users/9999');

        $response->assertStatus(Response::HTTP_OK)->assertExactJson(['error' => 'User not found']);
    }


    /**
     * @test
     */
    public function requestMustHaveUserId()
    {
        $idUser = 300;
        $user = new User($idUser, 'user@user.com');
        $this->userDataSource
            ->expects('findById')
            ->with($idUser)
            ->never()
            ->andReturn($user);

        $response = $this->get('/api/users/');

        $response->assertStatus(Response::HTTP_BAD_REQUEST)->assertExactJson(['error' => 'The user id is required']);
    }

    /**
     * @test
     */
    public function userWithGivenIdExists()
    {
        $idUser = 1;
        $user = new User($idUser, 'user@user.com');
        $this->userDataSource
            ->expects('findById')
            ->with($idUser)
            ->once()
            ->andReturn($user);

        $response = $this->get('/api/users/1');

        $response->assertStatus(Response::HTTP_OK)->assertExactJson(["{id:1, email:'user@user.com'}"]);
    }

}
