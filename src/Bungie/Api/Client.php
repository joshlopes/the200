<?php

namespace App\Bungie\Api;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Client
{

    public function __construct(\GuzzleHttp\Client $client, string $apiKey)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }


    public function request(RequestInterface $request, array $options = []): ResponseInterface
    {
        $request = $request->withAddedHeader('X-API-Key', $this->apiKey);

        return $this->client->send($request, $options);
    }
}
