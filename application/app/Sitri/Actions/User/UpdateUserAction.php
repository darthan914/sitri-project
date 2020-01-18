<?php


namespace App\Sitri\Actions\User;


use App\User;

class UpdateUserAction
{
    /**
     * @param int   $userId
     * @param array $data
     *
     * @return bool
     */
    public function execute($userId, array $data)
    {
        $user = User::query()->find($userId);

        if ($user->email !== $data['email']) {
            $data['token_verify'] = str_random();
        }

        return $user->update($data);
    }
}
