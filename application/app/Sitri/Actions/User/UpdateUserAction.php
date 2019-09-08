<?php


namespace App\Sitri\Actions\User;


use App\User;

class UpdateUserAction
{
    /**
     * @param User  $user
     * @param array $data
     *
     * @return bool
     */
    public function execute(User $user, array $data)
    {
        if($user->email !== $data['email']) {
            $data['token_verify'] = str_random();
        }

        return $user->update($data);
    }
}
