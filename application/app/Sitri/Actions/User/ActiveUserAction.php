<?php


namespace App\Sitri\Actions\User;


use App\User;

class ActiveUserAction
{
    /**
     * @param int  $userId
     * @param bool $setActive
     *
     * @return bool
     */
    public function execute($userId, $setActive)
    {
        return User::query()->find($userId)->update(['active' => $setActive]);
    }
}
