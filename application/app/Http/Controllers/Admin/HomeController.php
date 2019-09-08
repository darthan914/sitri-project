<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Sitri\Repositories\Schedule\ScheduleRepositoryInterface;

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

        return view('admin.home.index', compact('schedules', 'activeDayLists'));
    }
}
