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
            $classSchedules->where('day', Carbon::parse($date)->dayOfWeek);
        }

        $active = $collect->get('f_active');
        if(null !== $active) {
            $classSchedules->where('active', $active);
        }

        $student = $collect->get('f_student');
        if(null !== $student) {
            $classSchedules->whereHas('classStudents', function ($classStudents) use ($student) {
                $classStudents->where('student_id', $student);
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

    public function getIsTrial($active)
    {
        return ClassSchedule::query()->where('active', 1)->where('is_trial', $active)->get();
    }
}
