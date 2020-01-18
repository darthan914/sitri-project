<?php


namespace App\Sitri\Repositories\Reschedule;


use App\Sitri\Models\Admin\ClassSchedule;
use App\Sitri\Models\Admin\Reschedule;
use App\Sitri\Models\Admin\Schedule;
use App\Sitri\Models\Admin\Student;
use Carbon\Carbon;

class RescheduleRepository implements RescheduleRepositoryInterface
{
    public function all(array $with = [])
    {
        return Reschedule::query()->with($with)->get()->toArray();
    }

    public function find($rescheduleId, array $with = [])
    {
        return Reschedule::query()->with($with)->find($rescheduleId)->toArray();
    }

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

    public function getByStudentId($studentId)
    {
        return $this->getByRequest(['f_student' => $studentId]);
    }

    public function getFromRangeDate($startDate, $endDate)
    {
        return $this->getByRequest(['f_range_from_date' => [$startDate, $endDate]]);
    }

    public function getToRangeDate($startDate, $endDate)
    {
        return $this->getByRequest(['f_range_to_date' => [$startDate, $endDate]]);
    }
}
