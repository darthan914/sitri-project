<?php

namespace App\Sitri\Actions\User;

use App\User;

class ChangePasswordUserActions
{
    /**
     * @param User   $user
     * @param string $password
     *
     * @return bool
     */
    public function execute(User $user, $password)
    {
        return $user->update(['password' => bcrypt($password)]);
    }
}
