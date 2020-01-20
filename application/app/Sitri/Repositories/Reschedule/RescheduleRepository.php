<?php


namespace App\Sitri\Repositories\Reschedule;


use App\Sitri\Models\Admin\ClassSchedule;
use App\Sitri\Models\Admin\Reschedule;
use App\Sitri\Models\Admin\Schedule;
use App\Sitri\Models\Admin\Student;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class RescheduleRepository implements RescheduleRepositoryInterface
{
    /**
     * @param array $with
     *
     * @return array
     */
    public function all(array $with = [])
    {
        return Reschedule::query()->with($with)->get()->toArray();
    }

    /**
     * @param int   $rescheduleId
     * @param array $with
     *
     * @return array
     */
    public function find($rescheduleId, array $with = [])
    {
        return Reschedule::query()->with($with)->find($rescheduleId)->toArray();
    }

    /**
     * @param array $request
     * @param array $with
     *
     * @return array
     */
    public function getByRequest(array $request, array $with = [])
    {
        $reschedule = Reschedule::query()->with($with);

        $collect = collect($request);
        $student = $collect->get('f_student');
        if (null !== $student) {
            $reschedule->where('student_id', $student);
        }

        $rangeFromDate = $collect->get('f_range_from_date');
        if (null !== $rangeFromDate && is_array($rangeFromDate)) {
            $reschedule->whereBetween('from_date', $rangeFromDate);
        }

        $rangeToDate = $collect->get('f_range_to_date');
        if (null !== $rangeToDate && is_array($rangeToDate)) {
            $reschedule->whereBetween('to_date', $rangeToDate);
        }

        return $reschedule->get()->toArray();
    }

    /**
     * @param int    $studentId
     * @param string $date
     *
     * @return array
     */
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
                            ->toArray()
            ;
    }

    /**
     * @param int    $studentId
     * @param string $toDate
     * @param string $fromDate
     *
     * @return array
     */
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

        return $classSchedule->get()->toArray();
    }

    /**
     * @param int $studentId
     *
     * @return array
     */
    public function getDayStudentAvailable($studentId)
    {
        return ClassSchedule::query()
                            ->whereHas('classStudents', function (Builder $classStudent) use ($studentId) {
                                $classStudent->where('student_id', $studentId);
                            })->get()->pluck('schedule.day')->toArray()
            ;
    }


    /**
     * @param string $date
     * @param int    $classScheduleId
     *
     * @return array
     */
    public function getStudentRescheduleToByDateAndClassSchedule($date, $classScheduleId)
    {
        return Reschedule::query()
                         ->with('student')
                         ->where('to_date', $date)
                         ->where('to_class_schedule_id', $classScheduleId)
                         ->get()
                         ->toArray()
            ;
    }


    /**
     * @param int    $studentId
     * @param string $date
     * @param int    $classScheduleId
     *
     * @return bool
     */
    public function isStudentOnReschedule($studentId, $date, $classScheduleId)
    {
        return Reschedule::query()
                         ->where('student_id', $studentId)
                         ->where('from_date', $date)
                         ->where('from_class_schedule_id', $classScheduleId)
                         ->first() !== null
            ;
    }
}
