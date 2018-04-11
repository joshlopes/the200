<?php

namespace App\Bungie\Api\Model;

class Activity
{

    public function __construct(int $id, array $data, array $activityDetails = null)
    {
        $this->id = $id;
        $this->data = $data;
        $this->activityDetails = $activityDetails;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getActivityDetails(): array
    {
        return $this->activityDetails;
    }

    public function isCompleted(): bool
    {
        return (int) $this->data['values']['completed']['basic']['value'] > 0;
    }
}
