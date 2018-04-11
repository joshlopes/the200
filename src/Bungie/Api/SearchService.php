<?php

namespace App\Bungie\Api;

use App\Bungie\Api\Model\Guardian;
use Psr\Http\Message\ResponseInterface;

class SearchService extends AbstractApiService
{

    public function findGuardian(string $gameTag): Guardian
    {
        $request = new Request('GET', '/SearchDestinyPlayer/-1/'.$gameTag);

        $response = $this->client->request($request);
        $data = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);

        return new Guardian($data['Response'][0]['membershipId'], $data);
    }

}
