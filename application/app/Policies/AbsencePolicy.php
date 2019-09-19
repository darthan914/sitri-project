<?php

namespace App\Policies;

use App\Sitri\Models\Admin\Absence;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AbsencePolicy
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
        return $auth->hasAccess('list-absence');
    }

    public function create(User $auth)
    {
        return $auth->hasAccess('create-absence');
    }

    public function update(User $auth)
    {
        return $auth->hasAccess('update-absence');
    }

    public function delete(User $auth)
    {
        return $auth->hasAccess('delete-absence');
    }
}
