<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\General\ActiveRequest;
use App\Http\Requests\Admin\Schedule\IndexScheduleRequest;
use App\Http\Requests\Admin\Schedule\StoreScheduleRequest;
use App\Http\Requests\Admin\Schedule\UpdateScheduleRequest;
use App\Sitri\Actions\Schedule\ActiveScheduleAction;
use App\Sitri\Actions\Schedule\DeleteScheduleAction;
use App\Sitri\Actions\Schedule\StoreScheduleAction;
use App\Sitri\Actions\Schedule\UpdateScheduleAction;
use App\Sitri\Models\Admin\Schedule;
use App\Sitri\Repositories\Schedule\ScheduleRepositoryInterface;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class ScheduleController extends Controller
{
    /**
     * @var ScheduleRepositoryInterface
     */
    private $scheduleRepository;
    private $day = [
                'Sunday',
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday'
            ];

    /**
     * ScheduleController constructor.
     *
     * @param ScheduleRepositoryInterface $scheduleRepository
     */
    public function __construct(ScheduleRepositoryInterface $scheduleRepository)
    {
        $this->middleware('auth');

        $this->scheduleRepository = $scheduleRepository;
    }

    /**
     * @param IndexScheduleRequest $request
     *
     * @return Factory|View
     */
    public function index(IndexScheduleRequest $request)
    {
        $request->validated();

        return view('admin.schedule.index', compact('request'));
    }

    /**
     * @param IndexScheduleRequest $request
     *
     * @return mixed
     * @throws Exception
     */
    public function dataTable(IndexScheduleRequest $request)
    {
        $request->validated();

        $dataTable = Datatables::of($this->scheduleRepository->getByRequest($request->all()));

        $dataTable->addColumn('action', function ($index) {
            return view('admin.schedule.datatable.action', compact('index'));
        });

        $dataTable->editColumn('day', function ($index) {
            return $this->day[$index->day];
        });

        $dataTable->editColumn('active', function ($index) {
            $active = $index->active;
            return view('admin._general.datatable.active', compact('active'));
        });


        $dataTable = $dataTable->rawColumns(['action', 'active'])->make(true);
        return $dataTable;
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $day = $this->day;
        return view('admin.schedule.create', compact('day'));
    }

    /**
     * @param StoreScheduleRequest $request
     * @param StoreScheduleAction  $action
     *
     * @return RedirectResponse
     */
    public function store(StoreScheduleRequest $request, StoreScheduleAction $action)
    {
        $request->validated();

        $action->execute($request->all());

        return redirect()->route('admin.schedule.index')->with('success', 'Data has been added');
    }

    /**
     * @param Schedule $schedule
     *
     * @return Factory|View
     */
    public function edit(Schedule $schedule)
    {
        $day = $this->day;

        return view('admin.schedule.edit', compact('schedule', 'day'));
    }

    /**
     * @param Schedule              $schedule
     * @param UpdateScheduleRequest $request
     * @param UpdateScheduleAction  $action
     *
     * @return RedirectResponse
     */
    public function update(Schedule $schedule, UpdateScheduleRequest $request, UpdateScheduleAction $action)
    {
        $request->validated();

        $action->execute($schedule, $request->all());

        return redirect()->route('admin.schedule.index')->with('success', 'Data has been updated');
    }

    /**
     * @param Schedule             $schedule
     * @param DeleteScheduleAction $action
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(Schedule $schedule, DeleteScheduleAction $action)
    {
        $action->execute($schedule);

        return redirect()->route('admin.schedule.index')->with('success', 'Data has been deleted');
    }

    /**
     * @param Schedule             $schedule
     * @param ActiveRequest        $request
     * @param ActiveScheduleAction $action
     *
     * @return RedirectResponse
     */
    public function active(Schedule $schedule, ActiveRequest $request, ActiveScheduleAction $action)
    {
        $request->validated();

        $action->execute($schedule, $request->active);

        return redirect()->route('admin.schedule.index')->with('success', 'Data has been updated');
    }
}
