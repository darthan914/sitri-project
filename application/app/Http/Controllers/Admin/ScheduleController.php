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
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class ScheduleController extends Controller
{
    /**
     * @var ScheduleRepositoryInterface
     */
    private $scheduleRepository;

    /**
     * ScheduleController constructor.
     *
     * @param ScheduleRepositoryInterface $scheduleRepository
     */
    public function __construct(ScheduleRepositoryInterface $scheduleRepository)
    {
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

        $schedules = $this->scheduleRepository->getByRequest($request->all());
        $dataTable = Datatables::of($schedules);

        $dataTable->addColumn('action', function ($schedule) {
            return view('admin.schedule.datatable.action', compact('schedule'));
        });

        $dataTable->editColumn('day', function ($schedule) {
            return config('sitri.day')[$schedule['day']];
        });

        $dataTable->editColumn('active', function ($schedule) {
            $active = $schedule['active'];
            return view('admin._general.datatable.active', compact('active'));
        });

        return $dataTable->make(true);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $day = config('sitri.day');
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
     * @param int $id
     *
     * @return Factory|View
     */
    public function edit($id)
    {
        $schedule = $this->scheduleRepository->find($id);
        $day = config('sitri.day');

        return view('admin.schedule.edit', compact('schedule', 'day'));
    }

    /**
     * @param int                   $id
     * @param UpdateScheduleRequest $request
     * @param UpdateScheduleAction  $action
     *
     * @return RedirectResponse
     */
    public function update($id, UpdateScheduleRequest $request, UpdateScheduleAction $action)
    {
        $request->validated();

        $action->execute($id, $request->all());

        return redirect()->route('admin.schedule.index')->with('success', 'Data has been updated');
    }

    /**
     * @param int                  $id
     * @param DeleteScheduleAction $action
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function delete($id, DeleteScheduleAction $action)
    {
        $action->execute($id);

        return response()->json(['messages' => 'Data has been deleted!']);
    }

    /**
     * @param int                  $id
     * @param ActiveRequest        $request
     * @param ActiveScheduleAction $action
     *
     * @return RedirectResponse
     */
    public function active($id, ActiveRequest $request, ActiveScheduleAction $action)
    {
        $request->validated();

        $action->execute($id, $request->active);

        return response()->json(['messages' => 'Data has been updated!']);
    }
}
