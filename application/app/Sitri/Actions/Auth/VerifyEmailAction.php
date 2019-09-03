<?php


namespace App\Sitri\Actions\Auth;


use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class VerifyEmailAction
{
    /**
     * @param string $token
     *
     * @return Builder|Model
     * @throws Exception
     */
    public function execute($token)
    {
        if(null === $token) {
            throw new Exception('Token is required!');
        }

        $user = User::query()->where('token_verify', $token)->first();

        if($user)
        {
            $user->token_verify = null;
            $user->email_verified_at = Carbon::now()->format('Y-m-d H:i:s');
            $user->active = true;

            $user->save();

            return $user;
        }

        throw new Exception('Invalid token!');
    }
}
