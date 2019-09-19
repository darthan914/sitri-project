<?php

namespace App\Policies;

use App\Sitri\Models\Admin\Student;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPolicy
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
        return $auth->hasAccess('list-student');
    }

    public function create(User $auth)
    {
        return $auth->hasAccess('create-student');
    }

    public function update(User $auth, Student $student)
    {
        return $auth->hasAccess('update-student') && ($student->user === $auth ||$auth->hasAccess('full-user'));
    }

    public function delete(User $auth, Student $student)
    {
        return $auth->hasAccess('delete-student') && ($student->user === $auth ||$auth->hasAccess('full-user'));
    }
}
