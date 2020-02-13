<?php


namespace App\Sitri\Actions\Reschedule;


use App\Sitri\Models\Admin\ClassSchedule;
use App\Sitri\Models\Admin\ClassStudent;
use App\Sitri\Repositories\Reschedule\RescheduleRepositoryInterface;
use Carbon\Carbon;
use Exception;

class CheckRescheduleAction
{
    /**
     * @var RescheduleRepositoryInterface
     */
    private $rescheduleRepository;

    public function __construct(RescheduleRepositoryInterface $rescheduleRepository)
    {

        $this->rescheduleRepository = $rescheduleRepository;
    }

    /**
     * @param array $request
     *
     * @throws Exception
     */
    public function check(array $request)
    {
        if ($request['to_class_schedule_id'] == $request['from_class_schedule_id'] && $request['from_date'] == $request['to_date']) {
            throw new Exception('Class reschedule can not same date and class.');
        }

        $checkFromSchedule = count($this->rescheduleRepository
            ->getRegularStudentScheduleByDate($request['student_id'], $request['from_date']));

        if (0 == $checkFromSchedule) {
            throw new Exception('Class student at date not on list.');
        }

        $classSchedules = count($this->rescheduleRepository
            ->getRescheduleStudentAvailableByDate($request['student_id'], $request['to_date'], $request['from_date'])
        );

        if (0 == $classSchedules) {
            throw new Exception('Class schedule at date not on list.');
        }

        $checkStudent = ClassStudent::query()
                                    ->where('student_id', $request['student_id'])
                                    ->where('class_schedule_id', $request['to_class_schedule_id'])
                                    ->count()
        ;

        if ($checkStudent > 0 && $request['from_date'] == $request['to_date']) {
            throw new Exception('Class student has on regular schedule.');
        }
    }
}
