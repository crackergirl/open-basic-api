<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\UserDataSource\UserDataSource;
use Illuminate\Http\Response;
use Tests\TestCase;
use Exception;
use Mockery;

class userListControllerTest extends TestCase
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
            ->expects('listUsers')
            ->once()
            ->andThrow(new Exception('There was an error in the request'));

        $response = $this->get('/api/users/list');

        $response->assertStatus(Response::HTTP_BAD_REQUEST)->assertExactJson(['error' => 'There was an error in the request']);
    }

    /**
     * @test
     */
    public function checkIfListOfUsersIsEmpty()
    {
        $this->userDataSource
            ->expects('listUsers')
            ->once()
            ->andReturn([]);

        $response = $this->get('/api/users/list');

        $response->assertStatus(Response::HTTP_OK)->assertExactJson([]);
    }

    /**
     * @test
     */
    public function checkIfListOfUsersIsNotEmpty()
    {
        $this->userDataSource
            ->expects('listUsers')
            ->once()
            ->andReturn([1,2,2]);

        $response = $this->get('/api/users/list');

        $response->assertStatus(Response::HTTP_OK)->assertExactJson(["{id:'1'},{id:'2'},{id:'2'}"]);
    }
}
