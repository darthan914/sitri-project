<?php


namespace App\Sitri\Actions\User;


use App\User;

class ActiveUserAction
{
    /**
     * @param User $user
     * @param bool $setActive
     *
     * @return bool
     */
    public function execute(User $user, $setActive)
    {
        return $user->update(['active' => $setActive]);
    }
}
