<?php

namespace App\Policies;

use App\Sitri\Models\Admin\Schedule;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClassRoomPolicy
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
        return $auth->hasAccess('list-classRoom');
    }

    public function create(User $auth)
    {
        return $auth->hasAccess('create-classRoom');
    }

    public function update(User $auth)
    {
        return $auth->hasAccess('update-classRoom');
    }

    public function delete(User $auth)
    {
        return $auth->hasAccess('delete-classRoom');
    }
}
