<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
     * HomeController constructor.
     *
     * @param ScheduleRepositoryInterface $scheduleRepository
     * @param StudentRepositoryInterface  $studentRepository
     */
    public function __construct(ScheduleRepositoryInterface $scheduleRepository, StudentRepositoryInterface $studentRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
        $this->studentRepository = $studentRepository;
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

        $studentNotOnSchedule = $this->studentRepository->getStudentNotOnSchedule();

        return view('admin.home.index', compact('schedules', 'activeDayLists', 'weekDates', 'studentNotOnSchedule'));
    }
}
