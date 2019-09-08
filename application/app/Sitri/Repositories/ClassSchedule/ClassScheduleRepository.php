<?php


namespace App\Sitri\Repositories\ClassSchedule;


use App\Sitri\Models\Admin\ClassSchedule;

class ClassScheduleRepository implements ClassScheduleRepositoryInterface
{

    /**
     * @return mixed
     */
    public function all()
    {
        return ClassSchedule::query()->get();
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function getByRequest(array $data)
    {
        return ClassSchedule::query()->get();
    }

    /**
     * @param bool $active
     *
     * @return mixed
     */
    public function getIsActive($active)
    {
        return ClassSchedule::query()->where('active', $active)->get();
    }
}
