<?php

namespace App\Controller\Api;
use App\Bungie\BungieManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/api/v1/player")
 */
class PlayerController
{

    private $bungieManager;

    public function __construct(BungieManager $bungieManager)
    {
        $this->bungieManager = $bungieManager;
    }

    /**
     * @Route("/{gamerTag}/stats", requirements={"gamerTag"=".+"})
     */
    public function statsAction(string $gamerTag)
    {
        $raidCompletions = $this->bungieManager->getRaidCompletions($gamerTag);

        return new JsonResponse($raidCompletions);
    }

}
