<?php


namespace App\Sitri\Actions\Role;


use App\Sitri\Models\Admin\Role;

class ActiveRoleAction
{
    /**
     * @param Role     $role
     * @param          $active
     *
     * @return bool
     */
    public function execute(Role $role, $active)
    {
        return $role->update(['active' => $active]);
    }
}
