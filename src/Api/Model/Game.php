<?php

namespace App\Api\Model;

/**
 * @method getPlatform
 */
class Game extends AbstractModel
{
    /**
     * @return User[]
     */
    public function getPlayers(): array
    {
        $entrySessions = $this->data['confirmed_sessions'];
        $users = [];
        foreach ($entrySessions as $session) {
            $user = $session['user'];
            $users[] = new User($user['id'], $user);
        }

        return $users;
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
