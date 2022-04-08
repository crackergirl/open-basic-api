<?php

namespace Tests\app\Application\EarlyAdopter;

use App\Application\EarlyAdopter\IsEarlyAdopterService;
use Tests\app\Doubles\FakeUserDataSource;
use PHPUnit\Framework\TestCase;

class isFakeEarlyAdopterServiceTest extends TestCase
{
    private IsEarlyAdopterService $isEarlyAdopterService;

    /**
     * @test
     */
    public function userIdNotFound()
    {
        $this->isEarlyAdopterService = new IsEarlyAdopterService(new FakeUserDataSource());
        $id = '999';

        $isUserEarlyAdopter = $this->isEarlyAdopterService->login($id);

        $this->assertFalse($isUserEarlyAdopter);
    }



}
