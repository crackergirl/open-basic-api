<?php

namespace Tests\app\Application\UserBasicAPI;

use App\Application\UserBasicAPI\UserListService;
use App\Application\UserDataSource\UserDataSource;
use PHPUnit\Framework\TestCase;
use Mockery;

class UserListServiceTest extends TestCase
{
    private UserListService $userListService;
    private UserDataSource $userDataSource;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userDataSource = Mockery::mock(UserDataSource::class);

        $this->userListService = new UserListService($this->userDataSource);
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

        $response = $this->userListService->execute();

        $this->assertEquals([],$response);
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

        $response = $this->userListService->execute();

        $this->assertEquals([1,2,2],$response);
    }
}
