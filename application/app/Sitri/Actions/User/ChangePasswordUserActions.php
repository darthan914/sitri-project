<?php

namespace App\Sitri\Actions\User;

use App\User;

class ChangePasswordUserActions
{
    /**
     * @param User   $user
     * @param string $password
     *
     * @return User
     */
    public function execute(User $user, $password)
    {
        $user->password = bcrypt($password);
        $user->save();

        return $user;
    }
}
