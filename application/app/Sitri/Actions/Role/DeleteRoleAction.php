<?php


namespace App\Sitri\Actions\Role;


use App\Sitri\Models\Admin\Role;
use Exception;

class DeleteRoleAction
{
    /**
     * @param Role $role
     *
     * @return bool
     * @throws Exception
     */
    public function execute(Role $role)
    {
        return $role->delete();
    }
}
