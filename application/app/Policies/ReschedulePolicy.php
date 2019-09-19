<?php

namespace App\Policies;

use App\Sitri\Models\Admin\Reschedule;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReschedulePolicy
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
        return $auth->hasAccess('list-reschedule');
    }

    public function create(User $auth)
    {
        return $auth->hasAccess('create-reschedule');
    }

    public function update(User $auth, Reschedule $reschedule)
    {
        return $auth->hasAccess('update-reschedule') && ($reschedule->student->user === $auth || $auth->hasAccess('full-user'));
    }

    public function delete(User $auth, Reschedule $reschedule)
    {
        return $auth->hasAccess('delete-reschedule') && ($reschedule->student->user === $auth || $auth->hasAccess('full-user'));
    }
}
