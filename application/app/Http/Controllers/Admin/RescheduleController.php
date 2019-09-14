<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Reschedule\IndexRescheduleRequest;
use App\Http\Requests\Admin\Reschedule\StoreRescheduleRequest;
use App\Http\Requests\Admin\Reschedule\UpdateRescheduleRequest;
use App\Sitri\Actions\Reschedule\DeleteRescheduleAction;
use App\Sitri\Actions\Reschedule\StoreRescheduleAction;
use App\Sitri\Actions\Reschedule\UpdateRescheduleAction;
use App\Sitri\Models\Admin\Reschedule;
use App\Sitri\Repositories\Reschedule\RescheduleRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Sitri\Repositories\Student\StudentRepositoryInterface;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class RescheduleController extends Controller
{
    /**
     * @var RescheduleRepositoryInterface
     */
    private $rescheduleRepository;
    /**
     * @var StudentRepositoryInterface
     */
    private $studentRepository;

    /**
     * RescheduleController constructor.
     *
     * @param RescheduleRepositoryInterface $rescheduleRepository
     * @param StudentRepositoryInterface    $studentRepository
     */
    public function __construct(
        RescheduleRepositoryInterface $rescheduleRepository,
        StudentRepositoryInterface $studentRepository
    ) {
        $this->rescheduleRepository = $rescheduleRepository;
        $this->studentRepository = $studentRepository;
    }

    /**
     * @param IndexRescheduleRequest $request
     *
     * @return Factory|View
     */
    public function index(IndexRescheduleRequest $request)
    {
        $request->validated();
        $students = $this->studentRepository->all();

        return view('admin.reschedule.index', compact('request', 'students'));
    }

    /**
     * @param IndexRescheduleRequest $request
     *
     * @return mixed
     * @throws Exception
     */
    public function dataTable(IndexRescheduleRequest $request)
    {
        $request->validated();

        $dataTable = Datatables::of($this->rescheduleRepository->getByRequest($request->all()));

        $dataTable->addColumn('action', function ($index) {
            return view('admin.reschedule.datatable.action', compact('index'));
        });

        $dataTable->editColumn('from_date', function ($reschedule) {
            return view('admin.reschedule.datatable.from', compact('reschedule'));
        });

        $dataTable->editColumn('to_date', function ($reschedule) {
            return view('admin.reschedule.datatable.to', compact('reschedule'));
        });

        $dataTable->editColumn('student_id', function ($reschedule) {
            return $reschedule->student->name;
        });

        $dataTable = $dataTable->rawColumns(['action', 'from_date', 'to_date'])->make(true);
        return $dataTable;
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $students = $this->studentRepository->all();
        return view('admin.reschedule.create', compact('students'));
    }

    /**
     * @param StoreRescheduleRequest $request
     * @param StoreRescheduleAction  $action
     *
     * @return RedirectResponse
     */
    public function store(StoreRescheduleRequest $request, StoreRescheduleAction $action)
    {
        $request->validated();

        try {
            $action->execute($request->all());
        } catch (Exception $e) {
            return redirect()->route('admin.reschedule.index')->with('failed', $e->getMessage());
        }

        return redirect()->route('admin.reschedule.index')->with('success', 'Data has been added');
    }

    /**
     * @param Reschedule $reschedule
     *
     * @return Factory|View
     */
    public function edit(Reschedule $reschedule)
    {
        $fromScheduleClasses = $this->rescheduleRepository->getRegularStudentScheduleByDate($reschedule->student_id,
            $reschedule->from_date);
        $toScheduleClasses = $this->rescheduleRepository->getRescheduleStudentAvailableByDate($reschedule->student_id,
            $reschedule->to_date, $reschedule->from_date);
        $students = $this->studentRepository->all();

        return view('admin.reschedule.edit',
            compact('reschedule', 'students', 'fromScheduleClasses', 'toScheduleClasses'));
    }

    /**
     * @param Reschedule              $reschedule
     * @param UpdateRescheduleRequest $request
     * @param UpdateRescheduleAction  $action
     *
     * @return RedirectResponse
     */
    public function update(Reschedule $reschedule, UpdateRescheduleRequest $request, UpdateRescheduleAction $action)
    {
        $request->validated();

        try {
            $action->execute($reschedule, $request->all());
        } catch (Exception $e) {
            return redirect()->route('admin.reschedule.index')->with('failed', $e->getMessage());
        }

        return redirect()->route('admin.reschedule.index')->with('success', 'Data has been updated');
    }

    /**
     * @param Reschedule             $reschedule
     * @param DeleteRescheduleAction $action
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(Reschedule $reschedule, DeleteRescheduleAction $action)
    {
        $action->execute($reschedule);

        return redirect()->route('admin.reschedule.index')->with('success', 'Data has been deleted');
    }

    public function getRegularStudent(Request $request)
    {
        $regulars = $this->rescheduleRepository->getRegularStudentScheduleByDate($request->student_id, $request->date);

        $result = [];
        foreach ($regulars as $regular) {
            $result[] = [
                'id'   => $regular->id,
                'name' => $regular->getClassInfo(),
            ];
        }

        return $result;
    }

    public function getScheduleAvailable(Request $request)
    {
        $regulars = $this->rescheduleRepository->getRescheduleStudentAvailableByDate($request->student_id,
            $request->to_date, $request->from_date);

        $result = [];
        foreach ($regulars as $regular) {
            $result[] = [
                'id'   => $regular->id,
                'name' => $regular->getClassInfo(),
            ];
        }

        return $result;
    }
}
