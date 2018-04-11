<?php

namespace App\Bungie;

use App\Bungie\Api\ActivityService;
use App\Bungie\Api\ProfileService;
use App\Bungie\Api\SearchService;

class BungieManager
{

    public function __construct(SearchService $searchService, ProfileService $profileService, ActivityService $activityService)
    {
        $this->searchService = $searchService;
        $this->profileService = $profileService;
        $this->activityService = $activityService;
    }

    /**
     * @param string $gamerTag
     *
     * @return array
     */
    public function getRaidCompletions(string $gamerTag)
    {
        $guardian = $this->searchService->findGuardian($gamerTag);
        if (!$guardian) {
            return [];
        }

        $characters = $this->profileService->findGuardianCharacters($guardian);
        if (!$characters) {
            return [];
        }

        $finalRaid = [];
        foreach ($characters as $character) {
            $raids = $this->activityService->aggregateRaidData($guardian, $character);
            array_walk($raids, function ($val, $key) use (&$finalRaid) {
                /** @var \App\Bungie\Api\Model\ActivityAggregated $val */
                if (!isset($finalRaid[$key])) {
                    $finalRaid[$key] = $val->getCompletions();
                } else {
                    $finalRaid[$key] += $val->getCompletions();
                }
            });
        }

        return $finalRaid;
    }

}
