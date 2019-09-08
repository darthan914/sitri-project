<?php


namespace App\Sitri\Repositories\Schedule;


use App\Sitri\Models\Admin\Schedule;

class ScheduleRepository implements ScheduleRepositoryInterface
{

    /**
     * @return mixed
     */
    public function all()
    {
        return Schedule::query()->orderBy('day')->get();
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function getByRequest(array $data)
    {
        return Schedule::query()->orderBy('day')->get();
    }

    /**
     * @param bool $active
     *
     * @return mixed
     */
    public function getIsActive($active)
    {
        return Schedule::query()->where('active', $active)->orderBy('day')->get();
    }
}
