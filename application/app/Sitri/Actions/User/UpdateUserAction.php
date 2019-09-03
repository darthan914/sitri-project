<?php


namespace App\Sitri\Actions\User;


use App\User;

class UpdateUserAction
{
    /**
     * @param User  $user
     * @param array $data
     *
     * @return User
     */
    public function execute(User $user, array $data)
    {
        if($user->email !== $data['email']) {
            $user->token_verify = str_random();
        }

        $user->name = $data['name'];
        $user->email = $data['email'];

        $user->save();

        return $user;
    }
}
