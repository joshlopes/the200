<?php

namespace App\Api;

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

}
