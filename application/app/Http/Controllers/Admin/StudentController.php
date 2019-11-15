<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Student\StoreStudentRequest;
use App\Http\Requests\Admin\Student\UpdateStudentRequest;
use App\Http\Requests\Admin\User\IndexUserRequest;
use App\Sitri\Actions\Student\DeleteMultipleStudentAction;
use App\Sitri\Actions\Student\DeleteStudentAction;
use App\Sitri\Actions\Student\StoreStudentAction;
use App\Sitri\Actions\Student\UpdateStudentAction;
use App\Sitri\Models\Admin\Student;
use App\Sitri\Repositories\ClassRoom\ClassRoomRepositoryInterface;
use App\Sitri\Repositories\Student\StudentRepositoryInterface;
use App\Sitri\Repositories\User\UserRepositoryInterface;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    /**
     * @var StudentRepositoryInterface
     */
    private $studentRepository;
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var ClassRoomRepositoryInterface
     */
    private $classRoomRepository;

    /**
     * StudentController constructor.
     *
     * @param StudentRepositoryInterface   $studentRepository
     * @param UserRepositoryInterface      $userRepository
     * @param ClassRoomRepositoryInterface $classRoomRepository
     */
    public function __construct(
        StudentRepositoryInterface $studentRepository,
        UserRepositoryInterface $userRepository,
        ClassRoomRepositoryInterface $classRoomRepository
    ) {

        $this->studentRepository = $studentRepository;
        $this->userRepository = $userRepository;
        $this->classRoomRepository = $classRoomRepository;
    }

    /**
     * @param IndexUserRequest $request
     *
     * @return Factory|View
     */
    public function index(IndexUserRequest $request)
    {
        $request->validated();

        return view('admin.student.index', compact('request'));
    }

    /**
     * @param IndexUserRequest $request
     *
     * @return mixed
     * @throws Exception
     */
    public function dataTable(IndexUserRequest $request)
    {
        $request->validated();

        $dataTable = Datatables::of($this->studentRepository->getByRequest($request->all()));

        $dataTable->addColumn('check', function ($index) {
            $value = $index->id;
            return view('admin._general.datatable.check', compact('value'));
        });

        $dataTable->addColumn('action', function ($index) {
            return view('admin.student.datatable.action', compact('index'));
        });

        $dataTable->editColumn('name', function ($index) {
            return view('admin.student.datatable.information', compact('index'));
        });


        $dataTable = $dataTable->rawColumns(['check', 'action', 'name'])->make(true);
        return $dataTable;
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $classRooms = $this->classRoomRepository->all();
        $day = config('sitri.day');

        return view('admin.student.create', compact( 'classRooms', 'day'));
    }

    /**
     * @param StoreStudentRequest $request
     * @param StoreStudentAction  $action
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(StoreStudentRequest $request, StoreStudentAction $action)
    {
        $request->validated();

        $action->execute($request->all());

        return redirect()->route('admin.student.index')->with('success', 'Data has been added');
    }

    /**
     * @param Student $student
     *
     * @return Factory|View
     */
    public function view(Student $student)
    {
        return view('admin.student.view', compact('student'));
    }

    /**
     * @param Student $student
     *
     * @return Factory|View
     */
    public function edit(Student $student)
    {
        $classRooms = $this->classRoomRepository->all();
        $day = config('sitri.day');

        return view('admin.student.edit', compact('classRooms', 'student', 'day'));
    }

    /**
     * @param Student              $student
     * @param UpdateStudentRequest $request
     * @param UpdateStudentAction  $action
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(Student $student, UpdateStudentRequest $request, UpdateStudentAction $action)
    {
        $request->validated();

        $action->execute($student, $request->all());

        return redirect()->route('admin.student.index')->with('success', 'Data has been updated');
    }

    /**
     * @param Student             $student
     * @param DeleteStudentAction $action
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(Student $student, DeleteStudentAction $action)
    {
        $action->execute($student);

        return redirect()->route('admin.student.index')->with('success', 'Data has been deleted');
    }

    public function deleteMultiple(Request $request, DeleteMultipleStudentAction $action)
    {
        $action->execute($request->id);

        return redirect()->route('admin.student.index')->with('success', 'Data has been deleted');
    }
}
