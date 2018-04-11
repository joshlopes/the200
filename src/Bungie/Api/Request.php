<?php

namespace App\Bungie\Api;

class Request extends \GuzzleHttp\Psr7\Request
{

    private const BASE_URL = 'https://www.bungie.net/Platform/Destiny2/';

    public function __construct(string $method, $uri, array $headers = [], $body = null, string $version = '1.1')
    {
        $uri = self::BASE_URL . $uri;

        parent::__construct($method, $uri, $headers, $body, $version);
    }

}
