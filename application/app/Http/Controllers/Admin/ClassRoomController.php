<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClassRoom\IndexClassRoomRequest;
use App\Http\Requests\Admin\ClassRoom\StoreClassRoomRequest;
use App\Http\Requests\Admin\ClassRoom\UpdateClassRoomRequest;
use App\Http\Requests\Admin\General\ActiveRequest;
use App\Sitri\Actions\ClassRoom\ActiveClassRoomAction;
use App\Sitri\Actions\ClassRoom\DeleteClassRoomAction;
use App\Sitri\Actions\ClassRoom\StoreClassRoomAction;
use App\Sitri\Actions\ClassRoom\UpdateClassRoomAction;
use App\Sitri\Models\Admin\ClassRoom;
use App\Sitri\Repositories\ClassRoom\ClassRoomRepositoryInterface;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class ClassRoomController extends Controller
{
    /**
     * @var ClassRoomRepositoryInterface
     */
    private $classRoomRepository;

    /**
     * ClassRoomController constructor.
     *
     * @param ClassRoomRepositoryInterface $classRoomRepository
     */
    public function __construct(ClassRoomRepositoryInterface $classRoomRepository)
    {
        $this->classRoomRepository = $classRoomRepository;
    }

    /**
     * @param IndexClassRoomRequest $request
     *
     * @return Factory|View
     */
    public function index(IndexClassRoomRequest $request)
    {
        $request->validated();

        return view('admin.classRoom.index', compact('request'));
    }

    /**
     * @param IndexClassRoomRequest $request
     *
     * @return mixed
     * @throws Exception
     */
    public function dataTable(IndexClassRoomRequest $request)
    {
        $request->validated();

        $dataTable = Datatables::of($this->classRoomRepository->getByRequest($request->all()));

        $dataTable->addColumn('action', function ($index) {
            return view('admin.classRoom.datatable.action', compact('index'));
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
        return view('admin.classRoom.create');
    }

    /**
     * @param StoreClassRoomRequest $request
     * @param StoreClassRoomAction  $action
     *
     * @return RedirectResponse
     */
    public function store(StoreClassRoomRequest $request, StoreClassRoomAction $action)
    {
        $request->validated();

        $action->execute($request->all());

        return redirect()->route('admin.classRoom.index')->with('success', 'Data has been added');
    }

    /**
     * @param ClassRoom $classRoom
     *
     * @return Factory|View
     */
    public function edit(ClassRoom $classRoom)
    {
        return view('admin.classRoom.edit', compact('classRoom'));
    }

    /**
     * @param ClassRoom              $classRoom
     * @param UpdateClassRoomRequest $request
     * @param UpdateClassRoomAction  $action
     *
     * @return RedirectResponse
     */
    public function update(ClassRoom $classRoom, UpdateClassRoomRequest $request, UpdateClassRoomAction $action)
    {
        $request->validated();

        $action->execute($classRoom, $request->all());

        return redirect()->route('admin.classRoom.index')->with('success', 'Data has been updated');
    }

    /**
     * @param ClassRoom             $classRoom
     * @param DeleteClassRoomAction $action
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(ClassRoom $classRoom, DeleteClassRoomAction $action)
    {
        $action->execute($classRoom);

        return redirect()->route('admin.classRoom.index')->with('success', 'Data has been deleted');
    }

    /**
     * @param ClassRoom             $classRoom
     * @param ActiveRequest         $request
     * @param ActiveClassRoomAction $action
     *
     * @return RedirectResponse
     */
    public function active(ClassRoom $classRoom, ActiveRequest $request, ActiveClassRoomAction $action)
    {
        $request->validated();

        $action->execute($classRoom, $request->active);

        return redirect()->route('admin.classRoom.index')->with('success', 'Data has been updated');
    }
}
