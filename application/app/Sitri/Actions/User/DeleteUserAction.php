<?php


namespace App\Sitri\Actions\User;


use App\User;
use Exception;

class DeleteUserAction
{
    /**
     * @param User $user
     *
     * @return bool
     * @throws Exception
     */
    public function execute(User $user)
    {
        $user->delete();

        return true;
    }
}
