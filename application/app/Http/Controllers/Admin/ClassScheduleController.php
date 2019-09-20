<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClassSchedule\IndexClassScheduleRequest;
use App\Http\Requests\Admin\ClassSchedule\StoreClassScheduleRequest;
use App\Http\Requests\Admin\ClassSchedule\UpdateClassScheduleRequest;
use App\Http\Requests\Admin\General\ActiveRequest;
use App\Sitri\Actions\ClassSchedule\ActiveClassScheduleAction;
use App\Sitri\Actions\ClassSchedule\DeleteClassScheduleAction;
use App\Sitri\Actions\ClassSchedule\StoreClassScheduleAction;
use App\Sitri\Actions\ClassSchedule\UpdateClassScheduleAction;
use App\Sitri\Models\Admin\ClassSchedule;
use App\Sitri\Repositories\ClassRoom\ClassRoomRepositoryInterface;
use App\Sitri\Repositories\ClassSchedule\ClassScheduleRepositoryInterface;
use App\Sitri\Repositories\Schedule\ScheduleRepositoryInterface;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class ClassScheduleController extends Controller
{
    /**
     * @var ClassScheduleRepositoryInterface
     */
    private $classScheduleRepository;
    /**
     * @var ClassRoomRepositoryInterface
     */
    private $classRoomRepository;
    /**
     * @var ScheduleRepositoryInterface
     */
    private $scheduleRepository;

    /**
     * ClassScheduleController constructor.
     *
     * @param ClassScheduleRepositoryInterface $classScheduleRepository
     * @param ClassRoomRepositoryInterface     $classRoomRepository
     * @param ScheduleRepositoryInterface      $scheduleRepository
     */
    public function __construct(
        ClassScheduleRepositoryInterface $classScheduleRepository,
        ClassRoomRepositoryInterface $classRoomRepository,
        ScheduleRepositoryInterface $scheduleRepository
    ) {
        $this->middleware('auth');
        $this->classScheduleRepository = $classScheduleRepository;
        $this->classRoomRepository = $classRoomRepository;
        $this->scheduleRepository = $scheduleRepository;
    }

    /**
     * @param IndexClassScheduleRequest $request
     *
     * @return Factory|View
     */
    public function index(IndexClassScheduleRequest $request)
    {
        $request->validated();

        return view('admin.classSchedule.index', compact('request'));
    }

    /**
     * @param IndexClassScheduleRequest $request
     *
     * @return mixed
     * @throws Exception
     */
    public function dataTable(IndexClassScheduleRequest $request)
    {
        $request->validated();

        $dataTable = Datatables::of($this->classScheduleRepository->getByRequest($request->all()));

        $dataTable->addColumn('action', function ($index) {
            return view('admin.classSchedule.datatable.action', compact('index'));
        });

        $dataTable->editColumn('class_room_id', function ($index) {
            return $index->classRoom->name;
        });

        $dataTable->editColumn('schedule_id', function ($index) {
            return $index->schedule->getSchedule();
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
        $classRooms = $this->classRoomRepository->getIsActive(true);
        $schedules = $this->scheduleRepository->getIsActive(true);
        return view('admin.classSchedule.create', compact('classRooms', 'schedules'));
    }

    /**
     * @param StoreClassScheduleRequest $request
     * @param StoreClassScheduleAction  $action
     *
     * @return RedirectResponse
     */
    public function store(StoreClassScheduleRequest $request, StoreClassScheduleAction $action)
    {
        $request->validated();

        try {
            $action->execute($request->all());
        } catch (Exception $e) {
            return redirect()->route('admin.classSchedule.index')->with('failed', $e->getMessage());
        }

        return redirect()->route('admin.classSchedule.index')->with('success', 'Data has been added');
    }

    /**
     * @param ClassSchedule $classSchedule
     *
     * @return Factory|View
     */
    public function edit(ClassSchedule $classSchedule)
    {
        $classRooms = $this->classRoomRepository->getIsActive(true);
        $schedules = $this->scheduleRepository->getIsActive(true);
        return view('admin.classSchedule.edit', compact('classSchedule', 'classRooms', 'schedules'));
    }

    /**
     * @param ClassSchedule              $classSchedule
     * @param UpdateClassScheduleRequest $request
     * @param UpdateClassScheduleAction  $action
     *
     * @return RedirectResponse
     */
    public function update(
        ClassSchedule $classSchedule,
        UpdateClassScheduleRequest $request,
        UpdateClassScheduleAction $action
    ) {
        $request->validated();

        try {
            $action->execute($classSchedule, $request->all());
        } catch (Exception $e) {
            return redirect()->route('admin.classSchedule.index')->with('failed', $e->getMessage());
        }

        return redirect()->route('admin.classSchedule.index')->with('success', 'Data has been updated');
    }

    /**
     * @param ClassSchedule             $classSchedule
     * @param DeleteClassScheduleAction $action
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(ClassSchedule $classSchedule, DeleteClassScheduleAction $action)
    {
        $action->execute($classSchedule);

        return redirect()->route('admin.classSchedule.index')->with('success', 'Data has been deleted');
    }

    /**
     * @param ClassSchedule             $classSchedule
     * @param ActiveRequest             $request
     * @param ActiveClassScheduleAction $action
     *
     * @return RedirectResponse
     */
    public function active(ClassSchedule $classSchedule, ActiveRequest $request, ActiveClassScheduleAction $action)
    {
        $request->validated();

        $action->execute($classSchedule, $request->active);

        return redirect()->route('admin.classSchedule.index')->with('success', 'Data has been updated');
    }
}
