<?php

namespace App\Policies;

use App\Sitri\Models\Admin\ClassStudent;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClassStudentPolicy
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
        return $auth->hasAccess('list-classStudent');
    }

    public function create(User $auth)
    {
        return $auth->hasAccess('create-classStudent');
    }

    public function update(User $auth, ClassStudent $classStudent)
    {
        return $auth->hasAccess('update-classStudent') && ($classStudent->student->user === $auth || $auth->hasAccess('full-user'));
    }

    public function delete(User $auth, ClassStudent $classStudent)
    {
        return $auth->hasAccess('delete-classStudent') && ($classStudent->student->user === $auth || $auth->hasAccess('full-user'));
    }
}
