<?php

namespace App\Bungie\Api;

use App\Bungie\Api\Model\ActivityAggregated;
use App\Bungie\Api\Model\Guardian;
use App\Bungie\Api\Model\GuardianCharacter;
use App\Bungie\Api\Model\Activity;
use App\Bungie\Enum\RaidEnum;
use Doctrine\ORM\EntityManagerInterface;

class ActivityService extends AbstractApiService
{

    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $entityManager;

    public function __construct(Client $client, EntityManagerInterface $entityManager)
    {
        parent::__construct($client);

        $this->entityManager = $entityManager;
    }

    /**
     * @param \App\Bungie\Api\Model\Guardian $guardian
     * @param \App\Bungie\Api\Model\GuardianCharacter $guardianCharacter
     *
     * @return Activity[]
     */
    public function findActivities(Guardian $guardian, GuardianCharacter $guardianCharacter): array
    {
        $request = new Request(
            'GET',
            '2/Account/'.$guardian->getId().'/Character/'.$guardianCharacter->getId().'/Stats/Activities/?page=0&mode=raid&count=25'
        );
        $response = $this->client->request($request);

        $data = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
        $activities = [];
        if ($data['ErrorCode'] > 1) {
            return $activities;
        }

        foreach ($data['Response']['activities'] as $activity) {
            $directorHash = $activity['activityDetails']['directorActivityHash'];
            $activities[] = new Activity($directorHash, $activity, $this->getActivityDetails($directorHash));
        }

        return $activities;
    }

    /**
     * @param \App\Bungie\Api\Model\Guardian $guardian
     * @param \App\Bungie\Api\Model\GuardianCharacter $guardianCharacter
     *
     * @return ActivityAggregated[]
     */
    public function aggregateRaidData(Guardian $guardian, GuardianCharacter $guardianCharacter): array
    {
        $request = new Request(
            'GET',
            '2/Account/'.$guardian->getId().'/Character/'.$guardianCharacter->getId().'/Stats/AggregateActivityStats'
        );
        $response = $this->client->request($request);
        $data = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
        $aggregatedActivities = [];
        foreach ($data['Response']['activities'] as $datum) {
            $aggregatedActivities[$datum['activityHash']] = new ActivityAggregated($datum['activityHash'], $datum);
        }

        $activites = $this->findActivities($guardian, $guardianCharacter);
        $raids = (new RaidEnum())->getConstList();
        $return = [];
        foreach ($activites as $activity) {
            $activityName = $activity->getActivityDetails()['displayProperties']['name'];
            $raidKey = array_search($activityName, $raids, true);
            if (false !== $raidKey) {
                $aggregatedActivity = $aggregatedActivities[$activity->getActivityDetails()['hash']];
                if (!$aggregatedActivity) {
                    throw new \LogicException('I was expecting this activity to exist in the aggregated one');
                }

                $return[$raidKey] = $aggregatedActivity;
                unset($raids[$raidKey]);
            }

            if (!\count($raids)) {
                // we found all
                return $return;
            }
        }

        return $return;
    }

    private function getActivityDetails(string $directorHash)
    {
        $conn = $this->entityManager->getConnection();
        $query = $conn->executeQuery(
            'SELECT json FROM DestinyActivityDefinition WHERE json LIKE :query',
            [':query' => '%"hash":'.$directorHash.'%']
        );
        $json = $query->fetchColumn();
        if (!$json) {
            return null;
        }

        return \GuzzleHttp\json_decode($json, true);
    }

}
