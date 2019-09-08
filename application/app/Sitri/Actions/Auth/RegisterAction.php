<?php


namespace App\Sitri\Actions;


use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RegisterAction
{
    /**
     * @param array $request
     *
     * @return Builder|Model
     */
    public function execute(array $request)
    {
        $request['password'] = bcrypt($request['password']);
        $request['token_verify'] = str_random();

        return User::query()->create($request);
    }
}
