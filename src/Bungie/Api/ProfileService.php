<?php

namespace App\Bungie\Api;

use App\Bungie\Api\Model\Guardian;
use App\Bungie\Api\Model\GuardianCharacter;

class ProfileService extends AbstractApiService
{

    /**
     * @param \App\Bungie\Api\Model\Guardian $guardian
     *
     * @return GuardianCharacter[]
     */
    public function findGuardianCharacters(Guardian $guardian): array
    {
        $request = new Request('GET', '2/Profile/'.$guardian->getId().'/?components=Profiles%2CCharacters');
        $response = $this->client->request($request);
        $data = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);

        $characters = [];
        foreach($data['Response']['characters']['data'] as $characterId => $characterData) {
            $characters[] = new GuardianCharacter($characterId, $characterData);
        }

        return $characters;
    }

}
