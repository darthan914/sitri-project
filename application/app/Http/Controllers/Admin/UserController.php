<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\General\ActiveRequest;
use App\Http\Requests\Admin\User\ChangePasswordUserRequest;
use App\Http\Requests\Admin\User\IndexUserRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Sitri\Actions\User\ActiveUserAction;
use App\Sitri\Actions\User\ChangePasswordUserActions;
use App\Sitri\Actions\User\DeleteUserAction;
use App\Sitri\Actions\User\StoreUserAction;
use App\Sitri\Actions\User\UpdateUserAction;
use App\Sitri\Repositories\User\UserRepositoryInterface;
use App\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {

        $this->userRepository = $userRepository;
    }

    /**
     * @param IndexUserRequest $request
     *
     * @return Factory|View
     */
    public function index(IndexUserRequest $request)
    {
        $request->validated();

        return view('admin.user.index', compact('request'));
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

        $dataTable = Datatables::of($this->userRepository->getByRequest($request->all()));

        $dataTable->addColumn('action', function ($index) {
            return view('admin.user.datatable.action', compact('index'));
        });

        $dataTable->editColumn('name', function ($index) {
            return view('admin.user.datatable.information', compact('index'));
        });

        $dataTable->editColumn('active', function ($index) {
            $active = $index->active;
            return view('admin._general.datatable.active', compact('active'));
        });

        $dataTable = $dataTable->rawColumns(['check', 'active', 'action', 'name'])->make(true);
        return $dataTable;
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * @param StoreUserRequest $request
     * @param StoreUserAction  $action
     *
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request, StoreUserAction $action)
    {
        $request->validated();

        $action->execute($request->all());

        return redirect()->route('admin.user.index')->with('success', 'Data has been added');
    }

    /**
     * @param User $user
     *
     * @return Factory|View
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    /**
     * @param User              $user
     * @param UpdateUserRequest $request
     * @param UpdateUserAction  $action
     *
     * @return RedirectResponse
     */
    public function update(User $user, UpdateUserRequest $request, UpdateUserAction $action)
    {
        $request->validated();

        $action->execute($user, $request->all());

        return redirect()->route('admin.user.index')->with('success', 'Data has been updated');
    }

    /**
     * @param User             $user
     * @param DeleteUserAction $action
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(User $user, DeleteUserAction $action)
    {
        $action->execute($user);

        return redirect()->route('admin.user.index')->with('success', 'Data has been deleted');
    }

    /**
     * @param User              $user
     * @param ActiveUserRequest $request
     * @param ActiveUserAction  $action
     *
     * @return RedirectResponse
     */
    public function active(User $user, ActiveRequest $request, ActiveUserAction $action)
    {
        $request->validated();

        $action->execute($user, $request->get('active'));

        return redirect()->route('admin.user.index')->with('success', 'Data has been updated');
    }

    /**
     * @param User                      $user
     * @param ChangePasswordUserRequest $request
     * @param ChangePasswordUserActions $action
     *
     * @return RedirectResponse
     */
    public function changePassword(User $user, ChangePasswordUserRequest $request, ChangePasswordUserActions $action)
    {
        $request->validated();

        $action->execute($user, $request->get('password'));

        return redirect()->route('admin.user.index')->with('success', 'Data has been updated');
    }
}
