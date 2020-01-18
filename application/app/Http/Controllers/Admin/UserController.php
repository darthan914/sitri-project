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
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        $users = $this->userRepository->getByRequest($request->all());
        $dataTable = Datatables::of($users);

        $dataTable->addColumn('action', function ($user) {
            return view('admin.user.datatable.action', compact('user'));
        });

        $dataTable->editColumn('active', function ($user) {
            $active = $user['active'];
            return view('admin._general.datatable.active', compact('active'));
        });

        $dataTable = $dataTable->addIndexColumn()->make(true);

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
     * @param int $id
     *
     * @return Factory|View
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        return view('admin.user.edit', compact('user'));
    }

    /**
     * @param User              $user
     * @param UpdateUserRequest $request
     * @param UpdateUserAction  $action
     *
     * @return RedirectResponse
     */
    public function update($id, UpdateUserRequest $request, UpdateUserAction $action)
    {
        $request->validated();

        $action->execute($id, $request->except(['password']));

        return redirect()->route('admin.user.index')->with('success', 'Data has been updated');
    }

    /**
     * @param int              $id
     * @param DeleteUserAction $action
     *
     * @return JsonResponse
     */
    public function delete($id, DeleteUserAction $action)
    {
        $action->execute($id);

        return response()->json(['messages' => 'Data has been deleted!']);
    }

    /**
     * @param int              $id
     * @param ActiveRequest    $request
     * @param ActiveUserAction $action
     *
     * @return JsonResponse
     */
    public function active($id, ActiveRequest $request, ActiveUserAction $action)
    {
        $request->validated();

        $action->execute($id, $request->active);

        return response()->json(['messages' => 'Data has been updated!']);
    }

    /**
     * @param int                       $id
     * @param ChangePasswordUserRequest $request
     * @param ChangePasswordUserActions $action
     *
     * @return RedirectResponse
     */
    public function changePassword($id, ChangePasswordUserRequest $request, ChangePasswordUserActions $action)
    {
        $request->validated();

        $action->execute($id, $request->get('password'));

        return redirect()->route('admin.user.index')->with('success', 'Data has been updated');
    }

    public function getUserByEmail(Request $request)
    {
        return $this->userRepository->getUserByEmail($request->email)->toArray();
    }
}
