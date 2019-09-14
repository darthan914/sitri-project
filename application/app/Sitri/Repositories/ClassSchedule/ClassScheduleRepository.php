<?php


namespace App\Sitri\Repositories\ClassSchedule;


use App\Sitri\Models\Admin\ClassSchedule;
use Carbon\Carbon;

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
        $collect = collect($data);
        $classSchedules = ClassSchedule::query();

        $date = $collect->get('f_date');
        if(null !== $date) {
            $classSchedules->whereHas('schedule', function ($schedule) use ($date) {
                $schedule->where('day', Carbon::parse($date)->dayOfWeek);
            });
        }

        return $classSchedules->get();
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
