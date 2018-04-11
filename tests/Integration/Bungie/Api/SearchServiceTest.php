<?php

namespace App\Tests\Integration\Bungie\Api;

use App\Bungie\Api\Model\Guardian;
use App\Tests\BaseTestCase;

class SearchServiceTest extends BaseTestCase
{

    /**
     * @var \App\Bungie\Api\SearchService
     */
    private $searchService;

    protected function setUp()
    {
        $this->searchService = $this->getService('test.bungie.search_service');
    }

    public function testFindGuardian()
    {
        $guardian = $this->searchService->findGuardian('Josh_Lopes');

        $this->assertInstanceOf(Guardian::class, $guardian);
        $this->assertEquals('4611686018454285894', $guardian->getId());
    }

}
