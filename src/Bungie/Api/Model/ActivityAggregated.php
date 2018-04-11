<?php

namespace App\Bungie\Api\Model;

class ActivityAggregated
{

    public function __construct(int $id, array $data)
    {
        $this->id = $id;
        $this->data = $data;
    }

    public function getCompletions(): int
    {
        return (int) $this->data['values']['activityCompletions']['basic']['value'];
    }

    public function getId(): int
    {
        return $this->id;
    }
}
