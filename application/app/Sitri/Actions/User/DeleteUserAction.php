<?php


namespace App\Sitri\Actions\User;


use App\User;
use Exception;

class DeleteUserAction
{
    /**
     * @param int $userId
     *
     * @return bool
     */
    public function execute($userId)
    {
        return User::query()->where('id', $userId)->delete();
    }
}
