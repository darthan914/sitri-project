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
        return Schedule::query()->orderBy('day')->orderBy('start_time')->get();
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function getByRequest(array $data)
    {
        return Schedule::query()->orderBy('day')->orderBy('start_time')->get();
    }

    /**
     * @param bool $active
     *
     * @return mixed
     */
    public function getIsActive($active)
    {
        return Schedule::query()->where('active', $active)->orderBy('day')->orderBy('start_time')->get();
    }

    public function listDayActive()
    {
        return $this->getIsActive(true)->map(function ($schedule) { return $schedule->day; })->unique()->all();
    }

    public function getScheduleByDay($day)
    {
        return Schedule::query()->where('day', $day)->get();
    }
}
