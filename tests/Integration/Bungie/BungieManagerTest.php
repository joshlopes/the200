<?php

namespace App\Tests\Integration\Bungie;

use App\Bungie\Enum\RaidEnum;
use App\Tests\BaseTestCase;

class BungieManagerTest extends BaseTestCase
{

    /**
     * @var \App\Bungie\BungieManager
     */
    private $bungieManager;

    public function setUp()
    {
        $this->bungieManager = $this->getService('test.bungie_manager');
    }

    public function testGetCompletions()
    {
        $raidCompletions = $this->bungieManager->getRaidCompletions('ken7781');

        $this->assertArrayHasKey(RaidEnum::EOW, $raidCompletions);
        $this->assertArrayHasKey(RaidEnum::LEVIATHAN, $raidCompletions);

        $raidCompletions = $this->bungieManager->getRaidCompletions('Josh_lopes');

        $this->assertArrayHasKey(RaidEnum::EOW, $raidCompletions);
        $this->assertArrayHasKey(RaidEnum::LEVIATHAN, $raidCompletions);
    }
}
