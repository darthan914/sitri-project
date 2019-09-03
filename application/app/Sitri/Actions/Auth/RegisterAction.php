<?php


namespace App\Sitri\Actions;


use App\User;
use Illuminate\Http\Request;

class RegisterAction
{
    /**
     * @param array $data
     *
     * @return User
     */
    public function execute(array $data)
    {
        $user = new User();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->token_verify = str_random();

        $user->save();

        return $user;
    }
}
