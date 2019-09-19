<?php


namespace App\Sitri\Actions\Role;


use App\Sitri\Models\Admin\Role;

class UpdateRoleAction
{
    /**
     * @param Role  $role
     * @param array $request
     *
     * @return bool
     */
    public function execute(Role $role, array $request)
    {
        return $role->update($request);
    }
}
