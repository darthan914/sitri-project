<?php


namespace App\Sitri\Actions;


use App\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class LoginAction
{
    /**
     * @param string $email
     * @param string $password
     * @param bool   $remember_me
     *
     * @return bool
     * @throws Exception
     */
    public function execute($email, $password, $remember_me = false)
    {
        if (Auth::attempt(['email' => $email, 'password' => $password, 'active' => true], $remember_me)) {
            return true;
        }

        $user = User::query()->where('email', $email)->first();

        if ($user) {
            if (false == $user->active) {
                throw new Exception('Your email is not active.');
            }

            throw new Exception('Invalid password.');
        }

        throw new Exception('Email is not exist.');
    }
}
