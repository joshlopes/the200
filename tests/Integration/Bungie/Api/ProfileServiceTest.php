<?php

namespace App\Tests\Integration\Bungie\Api;

use App\Bungie\Api\Model\Guardian;
use App\Tests\BaseTestCase;

class ProfileServiceTest extends BaseTestCase
{

    /**
     * @var \App\Bungie\Api\ProfileService
     */
    private $profileService;

    public function setUp()
    {
        $this->profileService = $this->getService('test.bungie.profile_service');
    }

    public function testFindGuardianCharacters()
    {
        $guardian = new Guardian('4611686018454285894', []);
        $characters = $this->profileService->findGuardianCharacters($guardian);

        $this->assertCount(3, $characters);
    }

}
