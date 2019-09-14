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
     * @return mixed
     */
    public function all()
    {
        return Absence::query()->get();
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function getByRequest(array $data)
    {
        $absence = Absence::query();

        return $absence->get();
    }

    public function getStudentList($classScheduleId, $date)
    {
        return Student::query()
                      ->whereHas('classStudents', function ($classStudents) use ($classScheduleId) {
                          $classStudents->whereHas('classSchedule', function ($classSchedule) use ($classScheduleId) {
                              $classSchedule->where('id', $classScheduleId);
                          });
                      })
                      ->orWhereHas('reschedules', function ($reschedules) use ($classScheduleId, $date) {
                          $reschedules->where('to_class_schedule_id', $classScheduleId)->where('to_date', $date);
                      })
                      ->get()
            ;
    }

}
