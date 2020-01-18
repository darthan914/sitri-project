<?php


namespace App\Sitri\Repositories\ClassRoom;


use App\Sitri\Models\Admin\ClassRoom;

class ClassRoomRepository implements ClassRoomRepositoryInterface
{
    /**
     * @param array $with
     *
     * @return array
     */
    public function all(array $with = [])
    {
        return ClassRoom::query()->with($with)->orderBy('name')->get()->toArray();
    }

    /**
     * @param int   $classRoomId
     * @param array $with
     *
     * @return array
     */
    public function find($classRoomId, array $with = [])
    {
        return ClassRoom::query()->with($with)->find($classRoomId)->toArray();
    }

    /**
     * @param array $request
     * @param array $with
     *
     * @return array
     */
    public function getByRequest(array $request, array $with = [])
    {
        return ClassRoom::query()->with($with)->orderBy('name')->get()->toArray();
    }

    /**
     * @param bool $active
     *
     * @return array
     */
    public function getActive($active = true)
    {
        return ClassRoom::query()->where('active', $active)->orderBy('name')->get()->toArray();
    }

    /**
     * @param int $classRoomId
     *
     * @return int
     */
    public function getMaxStudent($classRoomId)
    {
        return $this->find($classRoomId)['max_student'];
    }
}
