<?php


namespace App\Sitri\Actions\Auth;


use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SendForgotPasswordAction
{
    /**
     * @param string $email
     *
     * @return Builder|Model
     * @throws Exception
     */
    public function execute($email)
    {
        $user = User::query()->where('email', $email)->first();

        if (!$user) {
            throw new Exception('Email is not on the list.');
        }

        $request['token_forgot_password'] = str_random();
        $request['expired_forgot_password'] = Carbon::now()->addDay()->toDateTimeString();

        return User::query()->create($request);
    }
}
