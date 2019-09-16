<?php


namespace App\Sitri\Repositories\Reschedule;


use App\Sitri\Models\Admin\ClassSchedule;
use App\Sitri\Models\Admin\Reschedule;
use App\Sitri\Models\Admin\Schedule;
use App\Sitri\Models\Admin\Student;
use Carbon\Carbon;

class RescheduleRepository implements RescheduleRepositoryInterface
{

    /**
     * @return mixed
     */
    public function all()
    {
        return Reschedule::query()->get();
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function getByRequest(array $data)
    {
        $collect = collect($data);
        $reschedule = Reschedule::query();

        $student = $collect->get('f_student');
        if (null !== $student) {
            $reschedule->where('student_id', $student);
        }

        return $reschedule->get();
    }


    public function getRegularStudentScheduleByDate($studentId, $date)
    {
        return ClassSchedule::query()
                            ->whereHas('schedule', function ($schedule) use ($date) {
                                $schedule->where('day', Carbon::parse($date)->dayOfWeek);
                            })
                            ->whereHas('classStudents', function ($classStudents) use ($studentId) {
                                $classStudents->where('student_id', $studentId);
                            })
                            ->get()
            ;
    }

    public function getRescheduleStudentAvailableByDate($studentId, $toDate, $fromDate)
    {
        $classSchedule = ClassSchedule::query()
                                      ->whereHas('schedule', function ($schedule) use ($toDate) {
                                          $schedule->where('day', Carbon::parse($toDate)->dayOfWeek);
                                      })
        ;

        if ($toDate === $fromDate) {
            $classSchedule->whereDoesntHave('classStudents', function ($classStudents) use ($studentId) {
                $classStudents->where('student_id', $studentId);
            });
        }

        return $classSchedule->get();
    }
}