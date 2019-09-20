<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
        return $auth->hasAccess('list-user');
    }

    public function create(User $auth)
    {
        return $auth->hasAccess('create-user');
    }

    public function update(User $auth, User $user)
    {
        return $auth->hasAccess('update-user') && ($auth->id === $user->id || $auth->hasAccess('full-user'));
    }

    public function delete(User $auth, User $user)
    {
        return $auth->hasAccess('delete-user') && $auth->id !== $user->id && $user->id !== User::USER_MASTER;
    }

    public function full(User $auth)
    {
        return $auth->hasAccess('full-user');
    }
}
