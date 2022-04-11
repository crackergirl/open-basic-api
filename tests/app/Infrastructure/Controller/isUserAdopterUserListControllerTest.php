<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\UserDataSource\UserDataSource;
use Illuminate\Http\Response;
use Tests\TestCase;
use Exception;
use Mockery;

class isUserAdopterUserListControllerTest extends TestCase
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
    /*public function genericError()
    {

        $this->userDataSource
            ->expects('listUsers')
            ->once()
            ->andReturn([]);

        $response = $this->get('/api/users/list/');

        $response->assertStatus(Response::HTTP_OK)->assertExactJson([]);
    }*/
}
