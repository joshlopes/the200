<?php

namespace App\Tests\Integration\Bungie\Api;

use App\Bungie\Api\Model\Guardian;
use App\Bungie\Api\Model\GuardianCharacter;
use App\Tests\BaseTestCase;

class ActivityServiceTest extends BaseTestCase
{
    /**
     * @var \App\Bungie\Api\ActivityService
     */
    private $service;

    public function setUp()
    {
        $this->service = $this->getService('test.bungie.activity_service');
    }

    public function testFindRaids()
    {
        $guardian = new Guardian(4611686018454285894, []);
        $character = new GuardianCharacter(2305843009290214604, []);

        $raids = $this->service->findActivities($guardian, $character);

        $this->assertNotEmpty($raids);
    }

    public function testAggregateRaidData()
    {
        $guardian = new Guardian(4611686018454285894, []);
        $character = new GuardianCharacter(2305843009290214604, []);

        $raids = $this->service->aggregateRaidData($guardian, $character);

        $this->assertNotEmpty($raids);
    }
}
