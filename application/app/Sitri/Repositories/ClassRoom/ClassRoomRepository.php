<?php


namespace App\Sitri\Repositories\ClassRoom;


use App\Sitri\Models\Admin\ClassRoom;

class ClassRoomRepository implements ClassRoomRepositoryInterface
{

    /**
     * @return mixed
     */
    public function all()
    {
        return ClassRoom::query()->orderBy('name')->get();
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function getByRequest(array $data)
    {
        return ClassRoom::query()->orderBy('name')->get();
    }

    /**
     * @param bool $active
     *
     * @return mixed
     */
    public function getIsActive($active)
    {
        return ClassRoom::query()->where('active', $active)->orderBy('name')->get();
    }
}
