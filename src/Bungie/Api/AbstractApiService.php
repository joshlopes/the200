<?php

namespace App\Bungie\Api;

abstract class AbstractApiService
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

}
