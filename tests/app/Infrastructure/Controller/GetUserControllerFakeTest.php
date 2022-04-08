<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\UserDataSource\UserDataSource;
use Tests\app\Doubles\FakeUserDataSource;
use Tests\TestCase;

class GetUserControllerFakeTest extends TestCase
{
    /**
     * @test
     */
    public function userWithGivenIdNotExists()
    {

        $this->app->bind(UserDataSource::class, fn () => new FakeUserDataSource());

        $response = $this->get('/api/users/999');

        $response->assertExactJson(['error' => 'user not found']);
    }

    /**
     * @test
     */
    public function userWithGivenIdExists()
    {

        $this->app->bind(UserDataSource::class, fn () => new FakeUserDataSource());

        $response = $this->get('/api/users/1');

        $response->assertExactJson(["{id: ‘1’, email:’user@user.com’}"]);
    }

}
