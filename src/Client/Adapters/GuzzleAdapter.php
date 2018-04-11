<?php

namespace App\Client\Adapters;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GuzzleAdapter implements AdapterInterface
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(\GuzzleHttp\Client $client)
    {
        $this->client = $client;
    }

    public function request(RequestInterface $request, array $options = []): ResponseInterface
    {
        return $this->client->send($request, $options);
    }
}
