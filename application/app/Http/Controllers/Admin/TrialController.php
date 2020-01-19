<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Student\StoreStudentRequest;
use App\Http\Requests\Admin\Student\UpdateStudentRequest;
use App\Http\Requests\Admin\Trial\IndexTrialRequest;
use App\Http\Requests\Admin\Trial\StoreChildTrialRequest;
use App\Http\Requests\Admin\Trial\StoreTrialRequest;
use App\Http\Requests\Admin\Trial\UpdateChildTrialRequest;
use App\Http\Requests\Admin\Trial\UpdateTrialRequest;
use App\Sitri\Actions\Schedule\StoreScheduleAction;
use App\Sitri\Actions\Student\DeleteStudentAction;
use App\Sitri\Actions\Student\StoreStudentAction;
use App\Sitri\Actions\Student\UpdateStudentAction;
use App\Sitri\Actions\Trial\DeleteChildTrialAction;
use App\Sitri\Actions\Trial\DeleteTrialAction;
use App\Sitri\Actions\Trial\StoreChildTrialAction;
use App\Sitri\Actions\Trial\StoreTrialAction;
use App\Sitri\Actions\Trial\UpdateChildTrialAction;
use App\Sitri\Actions\Trial\UpdateTrialAction;
use App\Sitri\Models\Admin\ChildTrial;
use App\Sitri\Models\Admin\ParentTrial;
use App\Sitri\Models\Admin\Student;
use App\Sitri\Repositories\ClassSchedule\ClassScheduleRepositoryInterface;
use App\Sitri\Repositories\Student\StudentRepositoryInterface;
use App\Sitri\Repositories\Trial\TrialRepositoryInterface;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class TrialController extends Controller
{
    /**
     * @var StudentRepositoryInterface
     */
    private $studentRepository;
    /**
     * @var ClassScheduleRepositoryInterface
     */
    private $classScheduleRepository;

    public function __construct(
        StudentRepositoryInterface $studentRepository,
        ClassScheduleRepositoryInterface $classScheduleRepository
    ) {

        $this->studentRepository = $studentRepository;
        $this->classScheduleRepository = $classScheduleRepository;
    }

    /**
     * @param IndexTrialRequest $request
     *
     * @return Factory|View
     */
    public function index(IndexTrialRequest $request)
    {
        $request->validated();

        return view('admin.trial.index', compact('request'));
    }

    /**
     * @param IndexTrialRequest $request
     *
     * @return mixed
     * @throws Exception
     */
    public function dataTable(IndexTrialRequest $request)
    {
        $request->validated();
        $request = $request->all();
        $request['is_trial'] = 1;

        $students = $this->studentRepository->getByRequest($request, ['user', 'classStudent.classSchedule']);

        $dataTable = Datatables::of($students);

        $dataTable->addColumn('action', function ($student) {
            return view('admin.trial.datatable.action', compact('student'));
        });

        return $dataTable->make(true);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $classSchedules = $this->classScheduleRepository->getIsTrial();

        return view('admin.trial.create', compact('classSchedules'));
    }

    /**
     * @param StoreTrialRequest $request
     * @param StoreTrialAction  $action
     *
     * @return RedirectResponse
     */
    public function store(StoreTrialRequest $request, StoreTrialAction $action)
    {
        $request->validated();

        $action->execute($request->all());

        return redirect()->route('admin.trial.index')->with('success', 'Data has been added');
    }

    /**
     * @param int $id
     *
     * @return Factory|View
     */
    public function edit($id)
    {
        $student = $this->studentRepository->find($id, ['user', 'classStudent']);
        $classSchedules = $this->classScheduleRepository->getIsTrial();

        return view('admin.trial.edit', compact('student', 'classSchedules'));
    }

    /**
     * @param int                 $id
     * @param UpdateTrialRequest  $request
     * @param UpdateStudentAction $action
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function update($id, UpdateTrialRequest $request, UpdateStudentAction $action)
    {
        $request->validated();

        $action->execute($id, $request->all(), true);

        return redirect()->route('admin.trial.index')->with('success', 'Data has been updated');
    }

    /**
     * @param int                 $id
     * @param DeleteStudentAction $action
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function delete($id, DeleteStudentAction $action)
    {
        $action->execute($id);

        return response()->json(['messages' => 'Data has been deleted']);
    }

}
