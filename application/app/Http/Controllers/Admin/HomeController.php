<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Sitri\Repositories\Schedule\ScheduleRepositoryInterface;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * @var ScheduleRepositoryInterface
     */
    private $scheduleRepository;

    public function __construct(ScheduleRepositoryInterface $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
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

        return view('admin.home.index', compact('schedules', 'activeDayLists', 'weekDates'));
    }
}
