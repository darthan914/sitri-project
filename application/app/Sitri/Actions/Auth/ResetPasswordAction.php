<?php


namespace App\Sitri\Actions\Auth;


use App\User;
use Exception;

class ResetPasswordAction
{
    /**
     * @param $token
     * @param $newPassword
     *
     * @return bool
     * @throws Exception
     */
    public function execute($token, $newPassword)
    {
        if (null === $token) {
            throw new Exception('Token is required.');
        }

        if (null === $newPassword) {
            throw new Exception('Password is required.');
        }

        $request['password'] = bcrypt($newPassword);
        $request['token_forgot_password'] = null;
        $request['expired_forgot_password'] = null;

        return User::query()->where('token_forgot_password', $token)->update($request);
    }
}
