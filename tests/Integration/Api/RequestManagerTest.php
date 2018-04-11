<?php

namespace App\Tests\Integration\Api;

use App\Api\RequestManager;
use App\Tests\BaseTestCase;

class RequestManagerTest extends BaseTestCase
{
    /**
     * @var RequestManager
     */
    private $requestManager;

    protected function setUp()
    {
        $this->requestManager = $this->getService('test.request_manager');
    }

    public function testGetGames()
    {
        $games = $this->requestManager->getGames();
        
        $this->assertNotEmpty($games);
    }
}
