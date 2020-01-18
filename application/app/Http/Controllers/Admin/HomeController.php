<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Sitri\Repositories\ClassSchedule\ClassScheduleRepositoryInterface;
use App\Sitri\Repositories\Reschedule\RescheduleRepositoryInterface;
use App\Sitri\Repositories\Schedule\ScheduleRepositoryInterface;
use App\Sitri\Repositories\Student\StudentRepositoryInterface;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * @var ScheduleRepositoryInterface
     */
    private $scheduleRepository;
    /**
     * @var StudentRepositoryInterface
     */
    private $studentRepository;
    /**
     * @var RescheduleRepositoryInterface
     */
    private $rescheduleRepository;
    /**
     * @var ClassScheduleRepositoryInterface
     */
    private $classScheduleRepository;

    /**
     * HomeController constructor.
     *
     * @param ScheduleRepositoryInterface      $scheduleRepository
     * @param StudentRepositoryInterface       $studentRepository
     * @param RescheduleRepositoryInterface    $rescheduleRepository
     * @param ClassScheduleRepositoryInterface $classScheduleRepository
     */
    public function __construct(
        ScheduleRepositoryInterface $scheduleRepository,
        StudentRepositoryInterface $studentRepository,
        RescheduleRepositoryInterface $rescheduleRepository,
        ClassScheduleRepositoryInterface $classScheduleRepository
    ) {
        $this->scheduleRepository = $scheduleRepository;
        $this->studentRepository = $studentRepository;
        $this->rescheduleRepository = $rescheduleRepository;
        $this->classScheduleRepository = $classScheduleRepository;
    }

    public function index()
    {
        $schedules = $this->scheduleRepository->getIsActive(true);
        $activeDayLists = $this->scheduleRepository->listDayActive();

        $startWeek = Carbon::now()->startOfWeek()->subDay(2);
        $weekDates = [];
        foreach (range(0, 6) as $week) {
            $weekDates[$week] = $startWeek->addDay()->toDateString();
        }

        $rescheduleFrom = $this->rescheduleRepository->getFromRangeDate($weekDates[0], $weekDates[6]);
        $listRescheduleFrom = [];
        foreach ($rescheduleFrom as $reschedule) {
            $listRescheduleFrom[$reschedule->from_date][$reschedule->student_id] = true;
        }

        $rescheduleTo = $this->rescheduleRepository->getToRangeDate($weekDates[0], $weekDates[6]);

        $studentNotOnSchedule = $this->studentRepository->getStudentsNotOnSchedule();

        $studentOnTrial = $this->studentRepository->getStudentsOnTrial();

        $classSchedules = $this->classScheduleRepository->all();

        return view('admin.home.index',
            compact('schedules', 'activeDayLists', 'weekDates', 'studentNotOnSchedule', 'listRescheduleFrom',
                'rescheduleTo', 'studentOnTrial', 'classSchedules'));
    }
}
