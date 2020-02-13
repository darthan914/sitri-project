<?php


namespace App\Sitri\Actions\Auth;


use App\User;
use Exception;

class CheckTokenForgotPasswordAction
{

    /**
     * @param string $token
     *
     * @return bool
     * @throws Exception
     */
    public function execute($token)
    {
        if (null == $token) {
            throw new Exception('Token is required.');
        }

        $user = User::query()->where('token_verify', $token)->first();

        if (!$user) {
            throw new Exception('Invalid token.');
        }

        return true;
    }
}
