<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\General\ActiveRequest;
use App\Http\Requests\Admin\Role\IndexRoleRequest;
use App\Http\Requests\Admin\Role\StoreRoleRequest;
use App\Http\Requests\Admin\Role\UpdateRoleRequest;
use App\Sitri\Actions\Role\ActiveRoleAction;
use App\Sitri\Actions\Role\DeleteRoleAction;
use App\Sitri\Actions\Role\StoreRoleAction;
use App\Sitri\Actions\Role\UpdateRoleAction;
use App\Sitri\Models\Admin\Role;
use App\Sitri\Repositories\Role\RoleRepositoryInterface;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    /**
     * @var RoleRepositoryInterface
     */
    private $roleRepository;
    private $day = [
                'Sunday',
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday'
            ];

    /**
     * RoleController constructor.
     *
     * @param RoleRepositoryInterface $roleRepository
     */
    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->middleware('auth');

        $this->roleRepository = $roleRepository;
    }

    /**
     * @param IndexRoleRequest $request
     *
     * @return Factory|View
     */
    public function index(IndexRoleRequest $request)
    {
        $request->validated();

        return view('admin.role.index', compact('request'));
    }

    /**
     * @param IndexRoleRequest $request
     *
     * @return mixed
     * @throws Exception
     */
    public function dataTable(IndexRoleRequest $request)
    {
        $request->validated();

        $dataTable = Datatables::of($this->roleRepository->getByRequest($request->all()));

        $dataTable->addColumn('action', function ($index) {
            return view('admin.role.datatable.action', compact('index'));
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
        $day = $this->day;
        return view('admin.role.create', compact('day'));
    }

    /**
     * @param StoreRoleRequest $request
     * @param StoreRoleAction  $action
     *
     * @return RedirectResponse
     */
    public function store(StoreRoleRequest $request, StoreRoleAction $action)
    {
        $request->validated();

        $action->execute($request->all());

        return redirect()->route('admin.role.index')->with('success', 'Data has been added');
    }

    /**
     * @param Role $role
     *
     * @return Factory|View
     */
    public function edit(Role $role)
    {
        $day = $this->day;

        return view('admin.role.edit', compact('role', 'day'));
    }

    /**
     * @param Role              $role
     * @param UpdateRoleRequest $request
     * @param UpdateRoleAction  $action
     *
     * @return RedirectResponse
     */
    public function update(Role $role, UpdateRoleRequest $request, UpdateRoleAction $action)
    {
        $request->validated();

        $action->execute($role, $request->all());

        return redirect()->route('admin.role.index')->with('success', 'Data has been updated');
    }

    /**
     * @param Role             $role
     * @param DeleteRoleAction $action
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(Role $role, DeleteRoleAction $action)
    {
        $action->execute($role);

        return redirect()->route('admin.role.index')->with('success', 'Data has been deleted');
    }

    /**
     * @param Role             $role
     * @param ActiveRequest        $request
     * @param ActiveRoleAction $action
     *
     * @return RedirectResponse
     */
    public function active(Role $role, ActiveRequest $request, ActiveRoleAction $action)
    {
        $request->validated();

        $action->execute($role, $request->active);

        return redirect()->route('admin.role.index')->with('success', 'Data has been updated');
    }
}
