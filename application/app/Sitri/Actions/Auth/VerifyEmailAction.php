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
     * @return bool|int
     * @throws Exception
     */
    public function execute($token)
    {
        if (null === $token) {
            throw new Exception('Token is required!');
        }

        $user = User::query()->where('token_verify', $token)->first();

        if (!isset($user)) {
            throw new Exception('Invalid token!');
        }

        $value['token_verify'] = null;
        $value['email_verified_at'] = Carbon::now()->toDateTimeString();
        $value['active'] = true;

        return $user->update($value);
    }
}
