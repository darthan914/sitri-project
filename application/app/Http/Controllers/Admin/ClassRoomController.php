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
use Illuminate\Http\JsonResponse;
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

        $classRooms = $this->classRoomRepository->getByRequest($request->all());
        $dataTable = Datatables::of($classRooms);

        $dataTable->addColumn('action', function ($classRoom) {
            return view('admin.classRoom.datatable.action', compact('classRoom'));
        });

        $dataTable->editColumn('active', function ($classRoom) {
            $active = $classRoom['active'];
            return view('admin._general.datatable.active', compact('active'));
        });


        $dataTable = $dataTable->make(true);
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

        try {
            $action->execute($request->all());
        } catch (Exception $e) {
            return redirect()->route('admin.classRoom.index')->with('failed', $e->getMessage());
        }

        return redirect()->route('admin.classRoom.index')->with('success', 'Data has been added');
    }

    /**
     * @param int $id
     *
     * @return Factory|View
     */
    public function edit($id)
    {
        $classRoom = $this->classRoomRepository->find($id);

        return view('admin.classRoom.edit', compact('classRoom'));
    }

    /**
     * @param int                    $id
     * @param UpdateClassRoomRequest $request
     * @param UpdateClassRoomAction  $action
     *
     * @return RedirectResponse
     */
    public function update($id, UpdateClassRoomRequest $request, UpdateClassRoomAction $action)
    {
        $request->validated();

        try {
            $action->execute($id, $request->all());
        } catch (Exception $e) {
            return redirect()->route('admin.classRoom.index')->with('failed', $e->getMessage());
        }

        return redirect()->route('admin.classRoom.index')->with('success', 'Data has been updated');
    }

    /**
     * @param int                   $id
     * @param DeleteClassRoomAction $action
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function delete($id, DeleteClassRoomAction $action)
    {
        $action->execute($id);

        return response()->json(['messages' => 'Data has been deleted!']);
    }

    /**
     * @param int                   $id
     * @param ActiveRequest         $request
     * @param ActiveClassRoomAction $action
     *
     * @return JsonResponse
     */
    public function active($id, ActiveRequest $request, ActiveClassRoomAction $action)
    {
        $request->validated();

        $action->execute($id, $request->active);

        return response()->json(['messages' => 'Data has been updated!']);
    }
}
