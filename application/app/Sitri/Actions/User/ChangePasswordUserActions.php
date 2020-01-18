<?php

namespace App\Sitri\Actions\User;

use App\User;

class ChangePasswordUserActions
{
    /**
     * @param int    $userId
     * @param string $password
     *
     * @return bool
     */
    public function execute($userId, $password)
    {
        return User::query()->find($userId)->update(['password' => bcrypt($password)]);
    }
}
