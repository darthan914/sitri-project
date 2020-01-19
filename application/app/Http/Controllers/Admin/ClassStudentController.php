<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClassStudent\IndexClassStudentRequest;
use App\Http\Requests\Admin\ClassStudent\StoreClassStudentRequest;
use App\Http\Requests\Admin\ClassStudent\UpdateClassStudentRequest;
use App\Sitri\Actions\ClassStudent\DeleteClassStudentAction;
use App\Sitri\Actions\ClassStudent\StoreClassStudentAction;
use App\Sitri\Actions\ClassStudent\UpdateClassStudentAction;
use App\Sitri\Models\Admin\ClassStudent;
use App\Sitri\Repositories\ClassSchedule\ClassScheduleRepositoryInterface;
use App\Sitri\Repositories\ClassStudent\ClassStudentRepositoryInterface;
use App\Sitri\Repositories\Student\StudentRepositoryInterface;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class ClassStudentController extends Controller
{
    /**
     * @var ClassStudentRepositoryInterface
     */
    private $classStudentRepository;
    /**
     * @var ClassScheduleRepositoryInterface
     */
    private $scheduleRepository;
    /**
     * @var StudentRepositoryInterface
     */
    private $studentRepository;

    /**
     * ClassStudentController constructor.
     *
     * @param ClassStudentRepositoryInterface  $classStudentRepository
     * @param ClassScheduleRepositoryInterface $scheduleRepository
     * @param StudentRepositoryInterface       $studentRepository
     */
    public function __construct(
        ClassStudentRepositoryInterface $classStudentRepository,
        ClassScheduleRepositoryInterface $scheduleRepository,
        StudentRepositoryInterface $studentRepository
    ) {
        $this->classStudentRepository = $classStudentRepository;
        $this->scheduleRepository = $scheduleRepository;
        $this->studentRepository = $studentRepository;
    }

    /**
     * @param IndexClassStudentRequest $request
     *
     * @return Factory|View
     */
    public function index(IndexClassStudentRequest $request)
    {
        $request->validated();

        return view('admin.classStudent.index', compact('request'));
    }

    /**
     * @param IndexClassStudentRequest $request
     *
     * @return mixed
     * @throws Exception
     */
    public function dataTable(IndexClassStudentRequest $request)
    {
        $request->validated();

        $classStudents = $this->classStudentRepository->getByRequest($request->all(), ['classSchedule', 'student']);

        $dataTable = Datatables::of($classStudents);

        $dataTable->addColumn('action', function ($classStudent) {
            return view('admin.classStudent.datatable.action', compact('classStudent'));
        });

        return $dataTable->make(true);
    }

    /**
     * @return Factory|View
     */
    public function create(Request $request)
    {
        $classSchedules = $this->scheduleRepository->getActive(true);
        $students = $this->studentRepository->all();
        return view('admin.classStudent.create', compact('classSchedules', 'students', 'request'));
    }

    /**
     * @param StoreClassStudentRequest $request
     * @param StoreClassStudentAction  $action
     *
     * @return RedirectResponse
     */
    public function store(StoreClassStudentRequest $request, StoreClassStudentAction $action)
    {
        $request->validated();

        try {
            $action->execute($request->all());
        } catch (Exception $e) {
            return redirect()->route('admin.classStudent.index')->with('failed', $e->getMessage());
        }

        return redirect()->route('admin.classStudent.index')->with('success', 'Data has been added');
    }

    /**
     * @param int $id
     *
     * @return Factory|View
     */
    public function edit($id)
    {
        $classStudent = $this->classStudentRepository->find($id);
        $classSchedules = $this->scheduleRepository->getActive(true);
        $students = $this->studentRepository->all();
        return view('admin.classStudent.edit', compact('classStudent', 'classSchedules', 'students'));
    }

    /**
     * @param int                       $id
     * @param UpdateClassStudentRequest $request
     * @param UpdateClassStudentAction  $action
     *
     * @return RedirectResponse
     */
    public function update(
        $id,
        UpdateClassStudentRequest $request,
        UpdateClassStudentAction $action
    ) {
        $request->validated();

        try {
            $action->execute($id, $request->all());
        } catch (Exception $e) {
            return redirect()->route('admin.classStudent.index')->with('failed', $e->getMessage());
        }

        return redirect()->route('admin.classStudent.index')->with('success', 'Data has been updated');
    }

    /**
     * @param int                      $id
     * @param DeleteClassStudentAction $action
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete($id, DeleteClassStudentAction $action)
    {
        $action->execute($id);

        return redirect()->route('admin.classStudent.index')->with('success', 'Data has been deleted');
    }
}
