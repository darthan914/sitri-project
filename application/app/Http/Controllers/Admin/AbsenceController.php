<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Absence\IndexAbsenceRequest;
use App\Http\Requests\Admin\Absence\StoreAbsenceRequest;
use App\Http\Requests\Admin\Absence\UpdateAbsenceRequest;
use App\Sitri\Actions\Absence\DeleteAbsenceAction;
use App\Sitri\Actions\Absence\StoreAbsenceAction;
use App\Sitri\Actions\Absence\UpdateAbsenceAction;
use App\Sitri\Models\Admin\Absence;
use App\Sitri\Repositories\Absence\AbsenceRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Sitri\Repositories\ClassSchedule\ClassScheduleRepositoryInterface;
use App\Sitri\Repositories\Schedule\ScheduleRepositoryInterface;
use App\Sitri\Repositories\Student\StudentRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class AbsenceController extends Controller
{
    /**
     * @var AbsenceRepositoryInterface
     */
    private $absenceRepository;
    /**
     * @var ScheduleRepositoryInterface
     */
    private $scheduleRepository;
    /**
     * @var ClassScheduleRepositoryInterface
     */
    private $classScheduleRepository;

    /**
     * AbsenceController constructor.
     *
     * @param AbsenceRepositoryInterface       $absenceRepository
     * @param ClassScheduleRepositoryInterface $classScheduleRepository
     * @param ScheduleRepositoryInterface      $scheduleRepository
     */
    public function __construct(
        AbsenceRepositoryInterface $absenceRepository,
        ClassScheduleRepositoryInterface $classScheduleRepository,
        ScheduleRepositoryInterface $scheduleRepository
    ) {
        $this->absenceRepository = $absenceRepository;
        $this->classScheduleRepository = $classScheduleRepository;
        $this->scheduleRepository = $scheduleRepository;
    }

    /**
     * @param IndexAbsenceRequest $request
     *
     * @return Factory|View
     */
    public function index(IndexAbsenceRequest $request)
    {
        $request->validated();

        return view('admin.absence.index', compact('request'));
    }

    /**
     * @param IndexAbsenceRequest $request
     *
     * @return mixed
     * @throws Exception
     */
    public function dataTable(IndexAbsenceRequest $request)
    {
        $request->validated();

        $absences = $this->absenceRepository->getByRequest($request->all(), ['classSchedule']);

        $dataTable = Datatables::of($absences);

        $dataTable->addColumn('action', function ($absence) {
            return view('admin.absence.datatable.action', compact('absence'));
        });

        $dataTable->editColumn('date', function ($absence) {
            return Carbon::parse($absence->date)->format('d F Y');
        });

        $dataTable = $dataTable->make(true);
        return $dataTable;
    }

    /**
     * @param Request $request
     *
     * @return Factory|View
     */
    public function create(Request $request)
    {
        $onlyDay = implode(',', $this->scheduleRepository->getActiveDay());

        return view('admin.absence.create', compact('request', 'onlyDay'));
    }

    /**
     * @param StoreAbsenceRequest $request
     * @param StoreAbsenceAction  $action
     *
     * @return RedirectResponse
     */
    public function store(StoreAbsenceRequest $request, StoreAbsenceAction $action)
    {
        $request->validated();

        try {
            $action->execute($request->all());
        } catch (Exception $e) {
            return redirect()->route('admin.absence.index')->with('failed', $e->getMessage());
        }

        return redirect()->route('admin.absence.index')->with('success', 'Data has been added');
    }

    /**
     * @param int     $id
     * @param Request $request
     *
     * @return Factory|View
     */
    public function edit($id, Request $request)
    {
        $absence = $this->absenceRepository->find($id, ['classSchedule', 'absenceDetails.student']);
        $classSchedules = $this->scheduleRepository->getByRequest(['f_date' => $absence['date']]);
        $onlyDay = implode(',', $this->scheduleRepository->getActiveDay());

        return view('admin.absence.edit', compact('absence', 'classSchedules', 'request', 'onlyDay'));
    }

    /**
     * @param int                  $id
     * @param UpdateAbsenceRequest $request
     * @param UpdateAbsenceAction  $action
     *
     * @return RedirectResponse
     */
    public function update($id, UpdateAbsenceRequest $request, UpdateAbsenceAction $action)
    {
        $request->validated();

        try {
            $action->execute($id, $request->all());
        } catch (Exception $e) {
            return redirect()->route('admin.absence.index')->with('failed', $e->getMessage());
        }

        return redirect()->route('admin.absence.index')->with('success', 'Data has been updated');
    }

    /**
     * @param int                 $id
     * @param DeleteAbsenceAction $action
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function delete($id, DeleteAbsenceAction $action)
    {
        $action->execute($id);

        return response()->json(['messages' => 'Data has been deleted!']);
    }

    public function getStudentList(Request $request)
    {
        $students = $this->absenceRepository->getStudentList($request->class_schedule_id, $request->date);

        return view('admin.absence.partial.studentList', compact('students'));
    }

    public function getScheduleDate(Request $request)
    {
        $classSchedules = $this->classScheduleRepository->getByRequest(['f_date' => $request->date]);

        $result = [];
        foreach ($classSchedules as $classSchedule) {
            $result[] = [
                'id'   => $classSchedule['id'],
                'name' => $classSchedule['class_info'],
            ];
        }

        return $result;
    }
}
