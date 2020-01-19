<?php


namespace App\Sitri\Repositories\ClassSchedule;


use App\Sitri\Models\Admin\ClassSchedule;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class ClassScheduleRepository implements ClassScheduleRepositoryInterface
{

    /**
     * @param array $with
     *
     * @return array
     */
    public function all(array $with = [])
    {
        return ClassSchedule::query()->with($with)->get()->toArray();
    }

    /**
     * @param       $id
     * @param array $with
     *
     * @return array
     */
    public function find($id, array $with = [])
    {
        return ClassSchedule::query()->with($with)->find($id)->toArray();
    }

    /**
     * @param array $request
     * @param array $with
     *
     * @return array
     */
    public function getByRequest(array $request, array $with = [])
    {
        $collect = collect($request);
        $classSchedules = ClassSchedule::query()->with($with);

        $date = $collect->get('f_date');
        if (null !== $date) {
            $classSchedules->whereHas('schedule', function (Builder $schedule) use ($date) {
                $schedule->where('day', Carbon::parse($date)->dayOfWeek);
            });
        }

        $active = $collect->get('f_active');
        if (null !== $active) {
            $classSchedules->where('active', $active);
        }

        $student = $collect->get('f_student');
        if (null !== $student) {
            $classSchedules->whereHas('classStudents', function ($classStudents) use ($student) {
                $classStudents->where('student_id', $student);
            });
        }

        return $classSchedules->get()->toArray();
    }

    /**
     * @param bool $active
     *
     * @return array
     */
    public function getActive($active = true)
    {
        return ClassSchedule::query()->where('active', $active)->get()->toArray();
    }

    public function getIsTrial($active = true)
    {
        return ClassSchedule::query()->where('active', 1)->where('is_trial', $active)->get()->toArray();
    }
}
