<?php

namespace App\Policies;

use App\Sitri\Models\Admin\Schedule;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
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
        return $auth->hasAccess('list-role');
    }

    public function create(User $auth)
    {
        return $auth->hasAccess('create-role');
    }

    public function update(User $auth)
    {
        return $auth->hasAccess('update-role');
    }

    public function delete(User $auth)
    {
        return $auth->hasAccess('delete-role');
    }
}
