<?php

namespace App\Controller\Api;
use App\Api\Model\Game;
use App\Api\RequestManager;
use App\Bungie\BungieManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/api/v1/games")
 */
class GamesController
{

    private $the100Manager;
    private $bungieManager;

    public function __construct(RequestManager $the100Manager, BungieManager $bungieManager)
    {
        $this->the100Manager = $the100Manager;
        $this->bungieManager = $bungieManager;
    }

    /**
     * @Route("")
     */
    public function listAction()
    {
        $games = $this->the100Manager->getGames();
        $return = [];
        foreach ($games as $game) {
            $return[] = $game->toArray();
        }

        return new JsonResponse($return);
    }

    /**
     * @Route("/{gameId}/stats")
     */
    public function statsAction(int $gameId)
    {
        $game = $this->the100Manager->getGame($gameId);
        $data = $game->toArray();
        foreach ($data['confirmed_sessions'] as &$session) {
            $gamerTag = $session['user']['gamertag'];
            $raidCompletions = $this->bungieManager->getRaidCompletions($gamerTag);

            $session['raid_completions'] = $raidCompletions;
        }

        return new JsonResponse($data);
    }

}
