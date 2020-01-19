<?php


namespace App\Sitri\Repositories\Schedule;


use App\Sitri\Models\Admin\Schedule;

class ScheduleRepository implements ScheduleRepositoryInterface
{
    /**
     * @param array $with
     *
     * @return array
     */
    public function all(array $with = [])
    {
        return Schedule::query()->with($with)->orderBy('day')->orderBy('start_time')->get()->toArray();
    }

    /**
     * @param int   $id
     * @param array $with
     *
     * @return array
     */
    public function find($id, array $with = [])
    {
        return Schedule::query()->with($with)->find($id)->toArray();
    }

    /**
     * @param array $request
     * @param array $with
     *
     * @return array
     */
    public function getByRequest(array $request, array $with = [])
    {
        return Schedule::query()->with($with)->orderBy('day')->orderBy('start_time')->get()->toArray();
    }

    /**
     * @param bool $active
     *
     * @return mixed
     */
    public function getActive($active = true)
    {
        return Schedule::query()
                       ->where('active', $active)
                       ->orderBy('day')
                       ->orderBy('start_time')
                       ->get()
                       ->toArray();
    }

    /**
     * @return array
     */
    public function getActiveDay()
    {
        return collect($this->getActive())->pluck('day')->unique()->all();
    }

    /**
     * @param int $day
     *
     * @return array
     */
    public function getScheduleByDay($day)
    {
        return Schedule::query()->where('day', $day)->get()->toArray();
    }
}
