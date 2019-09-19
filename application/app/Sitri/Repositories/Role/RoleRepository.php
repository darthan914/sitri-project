<?php


namespace App\Sitri\Repositories\Role;


use App\Sitri\Models\Admin\Role;

class RoleRepository implements RoleRepositoryInterface
{

    /**
     * @return mixed
     */
    public function all()
    {
        return Role::all();
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function getByRequest(array $data)
    {
        return Role::all();
    }

    /**
     * @param bool $active
     *
     * @return mixed
     */
    public function getIsActive($active)
    {
        return Role::query()->where('active', $active)->get();
    }
}
