<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClassSchedule\IndexClassScheduleRequest;
use App\Http\Requests\Admin\ClassSchedule\StoreClassScheduleRequest;
use App\Http\Requests\Admin\ClassSchedule\UpdateClassScheduleRequest;
use App\Http\Requests\Admin\General\ActiveRequest;
use App\Sitri\Actions\ClassSchedule\ActiveClassScheduleAction;
use App\Sitri\Actions\ClassSchedule\DeleteClassScheduleAction;
use App\Sitri\Actions\ClassSchedule\SetTrialClassScheduleAction;
use App\Sitri\Actions\ClassSchedule\StoreClassScheduleAction;
use App\Sitri\Actions\ClassSchedule\UpdateClassScheduleAction;
use App\Sitri\Models\Admin\ClassSchedule;
use App\Sitri\Repositories\ClassRoom\ClassRoomRepositoryInterface;
use App\Sitri\Repositories\ClassSchedule\ClassScheduleRepositoryInterface;
use App\Sitri\Repositories\Schedule\ScheduleRepositoryInterface;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        $classSchedules = $this->classScheduleRepository->getByRequest($request->all(), ['classRoom']);

        $dataTable = Datatables::of($classSchedules);

        $dataTable->addColumn('action', function ($classSchedule) {
            return view('admin.classSchedule.datatable.action', compact('classSchedule'));
        });

        $dataTable->editColumn('active', function ($classSchedule) {
            $active = $classSchedule['active'];
            return view('admin._general.datatable.active', compact('active'));
        });

        $dataTable->editColumn('is_trial', function ($classSchedule) {
            $active = $classSchedule['is_trial'];
            return view('admin._general.datatable.active', compact('active'));
        });

        $dataTable = $dataTable->rawColumns(['action', 'active', 'is_trial'])->make(true);
        return $dataTable;
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $classRooms = $this->classRoomRepository->getActive(true);
        $day = config('sitri.day');

        return view('admin.classSchedule.create', compact('classRooms', 'day', 'time'));
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
     * @param int $id
     *
     * @return Factory|View
     */
    public function edit($id)
    {
        $classSchedule = $this->classScheduleRepository->find($id);
        $classRooms = $this->classRoomRepository->getActive(true);
        $day = config('sitri.day');
        $time = config('sitri.time');

        return view('admin.classSchedule.edit', compact('classSchedule', 'classRooms', 'day', 'time'));
    }

    /**
     * @param int                        $id
     * @param UpdateClassScheduleRequest $request
     * @param UpdateClassScheduleAction  $action
     *
     * @return RedirectResponse
     */
    public function update(
        $id,
        UpdateClassScheduleRequest $request,
        UpdateClassScheduleAction $action
    ) {
        $request->validated();

        try {
            $action->execute($request->all());
        } catch (Exception $e) {
            return redirect()->route('admin.classSchedule.index')->with('failed', $e->getMessage());
        }

        return redirect()->route('admin.classSchedule.index')->with('success', 'Data has been updated');
    }

    /**
     * @param int                       $id
     * @param DeleteClassScheduleAction $action
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function delete($id, DeleteClassScheduleAction $action)
    {
        $action->execute($id);

        return response()->json(['messages' => 'Data has been deleted']);
    }

    /**
     * @param int                       $id
     * @param ActiveRequest             $request
     * @param ActiveClassScheduleAction $action
     *
     * @return JsonResponse
     */
    public function active($id, ActiveRequest $request, ActiveClassScheduleAction $action)
    {
        $request->validated();

        $action->execute($id, $request->active);

        return response()->json(['messages' => 'Data has been updated']);
    }

    /**
     * @param int                         $id
     * @param ActiveRequest               $request
     * @param SetTrialClassScheduleAction $action
     *
     * @return JsonResponse
     */
    public function trial($id, ActiveRequest $request, SetTrialClassScheduleAction $action)
    {
        $request->validated();

        $action->execute($id, $request->active);

        return response()->json(['messages' => 'Data has been updated']);
    }

    public function getTimeByDay(Request $request)
    {
        return $this->scheduleRepository->getScheduleByDay($request->day);
    }
}
