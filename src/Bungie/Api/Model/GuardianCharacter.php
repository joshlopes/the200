<?php

namespace App\Bungie\Api\Model;

class GuardianCharacter
{

    public function __construct(int $id, array $data)
    {
        $this->id = $id;
        $this->data = $data;
    }

    public function getId()
    {
        return $this->id;
    }
}
