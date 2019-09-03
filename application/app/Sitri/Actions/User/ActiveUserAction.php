<?php


namespace App\Sitri\Actions\User;


use App\User;

class ActiveUserAction
{
    /**
     * @param User $user
     * @param bool $setActive
     *
     * @return User
     */
    public function execute(User $user, $setActive)
    {
        $user->active = $setActive;
        $user->save();

        return $user;
    }
}
