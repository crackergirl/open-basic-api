<?php

namespace Tests\app\Application\EarlyAdopter;

use App\Application\EarlyAdopter\IsEarlyAdopterService;
use Tests\app\Doubles\FakeUserDataSource;
use PHPUnit\Framework\TestCase;

class isFakeEarlyAdopterServiceTest extends TestCase
{
    private IsEarlyAdopterService $isEarlyAdopterService;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->isEarlyAdopterService = new IsEarlyAdopterService(new FakeUserDataSource());
    }

    /**
     * @test
     */
    public function userIdNotFound()
    {
        $id = '999';

        $isUserEarlyAdopter = $this->isEarlyAdopterService->login($id);

        $this->assertFalse($isUserEarlyAdopter);
    }

    /**
     * @test
     */
    public function userIdFound()
    {
        $id = '1';

        $isUserEarlyAdopter = $this->isEarlyAdopterService->login($id);

        $this->assertTrue($isUserEarlyAdopter);
    }

    /**
     * @test
     */
    public function checkIfListOfUsersIsEmpty()
    {
        $isUserEarlyAdopterResponse = $this->isEarlyAdopterService->listUsers("empty");

        $this->assertEquals([],$isUserEarlyAdopterResponse);
    }


}
