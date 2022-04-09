<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\UserDataSource\UserDataSource;
use Tests\app\Doubles\FakeUserDataSource;
use Tests\TestCase;

class GetUserControllerFakeTest extends TestCase
{

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->app->bind(UserDataSource::class, fn () => new FakeUserDataSource());
    }

    /**
     * @test
     */
    public function userWithGivenIdNotExists()
    {
        $response = $this->get('/api/users/999');

        $response->assertExactJson(['error' => 'user not found']);
    }

    /**
     * @test
     */
    public function userWithGivenIdExists()
    {
        $response = $this->get('/api/users/1');

        $response->assertExactJson(["{id:1, email:’user@user.com’}"]);
    }

    /**
     * @test
     */
    public function checkIfListOfUsersIsEmpty()
    {
        $response = $this->get('/api/users/list');

        $response->assertExactJson([]);
    }


}
