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
use Illuminate\Http\JsonResponse;
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

        $students = $this->studentRepository->getByRequest($request->all(), ['user']);

        $dataTable = Datatables::of($students);

        $dataTable->addColumn('check', function ($student) {
            $value = $student['id'];
            return view('admin._general.datatable.check', compact('value'));
        });

        $dataTable->addColumn('action', function ($student) {
            return view('admin.student.datatable.action', compact('student'));
        });

        return $dataTable->make(true);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $classRooms = $this->classRoomRepository->all();
        $day = config('sitri.day');

        return view('admin.student.create', compact('classRooms', 'day'));
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
     * @param int $id
     *
     * @return Factory|View
     */
    public function view($id)
    {
        $student = $this->studentRepository->find($id, ['user', 'classStudent.classSchedule']);
        return view('admin.student.view', compact('student'));
    }

    /**
     * @param int $id
     *
     * @return Factory|View
     */
    public function edit($id)
    {
        $student = $this->studentRepository->find($id, ['user', 'classStudent.classSchedule.schedule']);
        $classRooms = $this->classRoomRepository->all();
        $day = config('sitri.day');

        return view('admin.student.edit', compact('classRooms', 'student', 'day'));
    }

    /**
     * @param int                  $id
     * @param UpdateStudentRequest $request
     * @param UpdateStudentAction  $action
     *
     * @return RedirectResponse
     */
    public function update($id, UpdateStudentRequest $request, UpdateStudentAction $action)
    {
        $request->validated();

        try {
            $action->execute($id, $request->all());
        } catch (Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());

        }

        return redirect()->route('admin.student.index')->with('success', 'Data has been updated');
    }

    /**
     * @param int                 $id
     * @param DeleteStudentAction $action
     *
     * @return JsonResponse
     */
    public function delete($id, DeleteStudentAction $action)
    {
        try {
            $action->execute($id);
        } catch (Exception $e) {
            return response()->json(['messages' => $e->getMessage()]);
        }

        return response()->json(['messages' => 'Data has been deleted!']);
    }

    /**
     * @param Request                     $request
     * @param DeleteMultipleStudentAction $action
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function deleteMultiple(Request $request, DeleteMultipleStudentAction $action)
    {
        $action->execute($request->id);

        return redirect()->route('admin.student.index')->with('success', 'Data has been deleted');
    }
}
