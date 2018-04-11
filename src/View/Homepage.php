<?php

namespace App\View;


use App\Api\RequestManager;
use App\Bungie\BungieManager;

class Homepage
{
    /**
     * @var \App\Api\RequestManager
     */
    private $requestManager;

    /**
     * @var \App\Bungie\BungieManager
     */
    private $bungieManager;

    /**
     * @param \App\Api\RequestManager $requestManager
     */
    public function __construct(RequestManager $requestManager, BungieManager $bungieManager)
    {
        $this->requestManager = $requestManager;
        $this->bungieManager = $bungieManager;
    }

    /**
     * @return \App\Api\Model\Game[]
     */
    public function getGames(): array
    {
        return $this->requestManager->getGames();
    }

    public function getCompletions($gamerTag): array
    {
        try {
            return $this->bungieManager->getRaidCompletions($gamerTag);
        } catch (\Exception $exception) {
            //throw new \Exception('Failed to get completions for ' . $gamerTag);
            return [];
        }

    }
}
