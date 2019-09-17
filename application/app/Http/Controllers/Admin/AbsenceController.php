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
use App\Sitri\Repositories\Student\StudentRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\Factory;
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
     * @var ClassScheduleRepositoryInterface
     */
    private $scheduleRepository;

    /**
     * AbsenceController constructor.
     *
     * @param AbsenceRepositoryInterface       $absenceRepository
     * @param ClassScheduleRepositoryInterface $scheduleRepository
     */
    public function __construct(
        AbsenceRepositoryInterface $absenceRepository,
        ClassScheduleRepositoryInterface $scheduleRepository
    ) {
        $this->absenceRepository = $absenceRepository;
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

        $dataTable = Datatables::of($this->absenceRepository->getByRequest($request->all()));

        $dataTable->addColumn('action', function ($index) {
            return view('admin.absence.datatable.action', compact('index'));
        });

        $dataTable->editColumn('class_schedule_id', function ($absence) {
            return $absence->classSchedule->getClassInfo();
        });

        $dataTable->editColumn('date', function ($absence) {
            return Carbon::parse($absence->date)->format('d F Y');
        });

        $dataTable = $dataTable->rawColumns(['action'])->make(true);
        return $dataTable;
    }

    /**
     * @param Request $request
     *
     * @return Factory|View
     */
    public function create(Request $request)
    {
        return view('admin.absence.create', compact('request'));
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
     * @param Absence $absence
     * @param Request $request
     *
     * @return Factory|View
     */
    public function edit(Absence $absence, Request $request)
    {
        $classSchedules = $this->scheduleRepository->getByRequest(['f_date' => $absence->date]);

        return view('admin.absence.edit', compact('absence', 'classSchedules', 'request'));
    }

    /**
     * @param Absence              $absence
     * @param UpdateAbsenceRequest $request
     * @param UpdateAbsenceAction  $action
     *
     * @return RedirectResponse
     */
    public function update(Absence $absence, UpdateAbsenceRequest $request, UpdateAbsenceAction $action)
    {
        $request->validated();

        try {
            $action->execute($absence, $request->all());
        } catch (Exception $e) {
            return redirect()->route('admin.absence.index')->with('failed', $e->getMessage());
        }

        return redirect()->route('admin.absence.index')->with('success', 'Data has been updated');
    }

    /**
     * @param Absence             $absence
     * @param DeleteAbsenceAction $action
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(Absence $absence, DeleteAbsenceAction $action)
    {
        $action->execute($absence);

        return redirect()->route('admin.absence.index')->with('success', 'Data has been deleted');
    }

    public function getStudentList(Request $request)
    {
        $students = $this->absenceRepository->getStudentList($request->class_schedule_id, $request->date);
        $date = $request->date;

        return view('admin.absence.partial.studentList', compact('students', 'date'));
    }

    public function getScheduleDate(Request $request)
    {
        $classSchedules = $this->scheduleRepository->getByRequest(['f_date' => $request->date]);

        $result = [];
        foreach ($classSchedules as $classSchedule) {
            $result[] = [
                'id'   => $classSchedule->id,
                'name' => $classSchedule->getClassInfo(),
            ];
        }

        return $result;
    }
}
