<?php

namespace App\Bungie\Api\Model;

class Guardian
{

    public function __construct(int $membershipId, array $jsonData)
    {
        $this->id = $membershipId;
        $this->data = $jsonData;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
