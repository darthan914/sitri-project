<?php


namespace App\Sitri\Actions\Role;


use App\Sitri\Models\Admin\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class StoreRoleAction
{
    /**
     * @param array $request
     *
     * @return Builder|Model
     */
    public function execute(array $request)
    {
        return Role::query()->create($request);
    }
}
