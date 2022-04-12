<?php

namespace Tests\app\Infrastructure\Controller;

use App\Domain\User;
use Tests\TestCase;
use App\Application\UserDataSource\UserDataSource;
use Exception;
use Illuminate\Http\Response;
use Mockery;

class userControllerTest extends TestCase
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
        $this->userDataSource
            ->expects('findById')
            ->with(300)
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
        $this->userDataSource
            ->expects('findById')
            ->with(9999)
            ->once()
            ->andThrow(new Exception('User not found'));

        $response = $this->get('/api/users/9999');

        $response->assertStatus(Response::HTTP_BAD_REQUEST)->assertExactJson(['error' => 'User not found']);
    }

    /**
     * @test
     */
    public function requestMustHaveUserId()
    {
        $user = new User(300, 'user@user.com');

        $this->userDataSource
            ->expects('findById')
            ->with(300)
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

        $user = new User($idUser, 'patata@gmail.com');

        $this->userDataSource
            ->expects('findById')
            ->with($idUser)
            ->once()
            ->andReturn($user);

        $response = $this->get('/api/users/1');

        $response->assertStatus(Response::HTTP_OK)->assertExactJson(["{id:1, email:'patata@gmail.com'}"]);
    }
}
