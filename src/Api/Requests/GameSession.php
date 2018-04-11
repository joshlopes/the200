<?php

namespace App\Api\Requests;

use App\Api\Model\Game;
use App\Client\Client;

class GameSession
{

    public const URL = 'https://www.the100.io/api/v1/gaming_sessions/{{id}}';
    private $gameId;

    /**
     * @var Game|null
     */
    private $game;

    public function __construct(int $id)
    {
        $this->gameId = $id;
    }

    public function fetch(Client $client)
    {
        $request = new Request('GET', strtr(self::URL, ['{{id}}' => $this->gameId]));

        $response = $client->request($request);
        $this->game = $this->handleResponse($response);
    }

    public function result(): Game
    {
        return $this->game;
    }

    private function handleResponse($response)
    {
        $gameData = \json_decode($response->getBody()->getContents(), true);

        return new Game($gameData['id'], $gameData);
    }
}
