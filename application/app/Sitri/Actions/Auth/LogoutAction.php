<?php


namespace App\Sitri\Actions\Auth;


use Illuminate\Support\Facades\Auth;

class LogoutAction
{
    public function execute()
    {
        Auth::logout();
    }
}
