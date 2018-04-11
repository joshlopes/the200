<?php

namespace App\Api;

use App\Api\Model\Game;
use App\Api\Requests\GameSession;
use App\Api\Requests\GamingSessions;
use App\Client\Client;

class RequestManager
{
    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return \App\Api\Model\Game[]
     */
    public function getGames(): array
    {
        $gamingSessions = new GamingSessions();
        $gamingSessions->fetch($this->client);

        return $gamingSessions->result();
    }

    public function getGame(int $id): ?Game
    {
        $gameSession = new GameSession($id);
        $gameSession->fetch($this->client);

        return $gameSession->result();
    }

}
