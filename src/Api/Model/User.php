<?php

namespace App\Api\Model;

/**
 * @method getGamertag()
 */
class User extends AbstractModel
{

    public function getAvatar()
    {
        $computedAvatar = $this->data['computed_avatar_api'];
        if (false === strpos($computedAvatar, 'http')) {
            $computedAvatar = 'https://www.the100.io/assets/ghost-75-0597ce44d6088c4bd9e53b0228f80cb7a5516d442e539b3e421bbb32df00e4de.png';
        }

        return $computedAvatar;
    }

}
