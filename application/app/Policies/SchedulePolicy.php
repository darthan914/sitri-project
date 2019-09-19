<?php

namespace App\Policies;

use App\Sitri\Models\Admin\Schedule;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchedulePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function list(User $auth)
    {
        return $auth->hasAccess('list-schedule');
    }

    public function create(User $auth)
    {
        return $auth->hasAccess('create-schedule');
    }

    public function update(User $auth)
    {
        return $auth->hasAccess('update-schedule');
    }

    public function delete(User $auth)
    {
        return $auth->hasAccess('delete-schedule');
    }
}
