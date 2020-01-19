<?php


namespace App\Sitri\Repositories\Absence;


use App\Sitri\Models\Admin\ClassSchedule;
use App\Sitri\Models\Admin\Absence;
use App\Sitri\Models\Admin\Schedule;
use App\Sitri\Models\Admin\Student;
use Carbon\Carbon;

class AbsenceRepository implements AbsenceRepositoryInterface
{

    /**
     * @param array $with
     *
     * @return array
     */
    public function all(array $with = [])
    {
        return Absence::query()->with($with)->get()->toArray();
    }

    /**
     * @param int   $id
     * @param array $with
     *
     * @return array
     */
    public function find($id, array $with = [])
    {
        return Absence::query()->with($with)->find($id)->toArray();
    }

    /**
     * @param array $data
     * @param array $with
     *
     * @return array
     */
    public function getByRequest(array $data, array $with = [])
    {
        $absence = Absence::query()->with($with);

        return $absence->get();
    }

    /**
     * @param int    $classScheduleId
     * @param string $date
     *
     * @return array
     */
    public function getStudentList($classScheduleId, $date)
    {
        $students = Student::query()
                      ->whereHas('classStudents', function ($classStudents) use ($classScheduleId) {
                          $classStudents->where('class_schedule_id', $classScheduleId);
                      })
                      ->orWhereHas('reschedules', function ($reschedules) use ($classScheduleId, $date) {
                          $reschedules->where('to_class_schedule_id', $classScheduleId)->where('to_date', $date);
                      })
                      ->get()
            ;

        foreach ($students as $student) {
            $student->is_reschedule = $student->isReschedule($date);
        }

        return $students->toArray();
    }

}
