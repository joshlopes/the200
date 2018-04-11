<?php

namespace App\Api\Requests;

use App\Api\Model\Game;
use App\Client\Client;
use Psr\Http\Message\ResponseInterface;

class GamingSessions
{
    public const URL = 'https://www.the100.io/api/v1/gaming_sessions';

    /**
     * @var Game[]
     */
    private $games = [];

    public function fetch(Client $client)
    {
        $request = new Request('GET', self::URL);

        $response = $client->request($request);
        $this->games = $this->handleResponse($response);
    }

    /**
     * @return Game[]
     */
    public function result(): array
    {
        return $this->games;
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return Game[]
     */
    private function handleResponse(ResponseInterface $response)
    {
        $games = [];
        $data = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
        foreach ($data as $game) {
            $games[] = new Game($game['id'], $game);
        }

        return $games;
    }

}
