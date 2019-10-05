<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Student\StoreStudentRequest;
use App\Http\Requests\Admin\Student\UpdateStudentRequest;
use App\Http\Requests\Admin\Trial\IndexTrialRequest;
use App\Http\Requests\Admin\Trial\StoreChildTrialRequest;
use App\Http\Requests\Admin\Trial\StoreTrialRequest;
use App\Http\Requests\Admin\Trial\UpdateChildTrialRequest;
use App\Http\Requests\Admin\Trial\UpdateTrialRequest;
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
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class TrialController extends Controller
{
    /**
     * @var TrialRepositoryInterface
     */
    private $trialRepository;
    /**
     * @var ClassScheduleRepositoryInterface
     */
    private $classScheduleRepository;

    public function __construct(TrialRepositoryInterface $trialRepository, ClassScheduleRepositoryInterface $classScheduleRepository)
    {

        $this->trialRepository = $trialRepository;
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

        $dataTable = Datatables::of($this->trialRepository->getByRequest($request->all()));

        $dataTable->addColumn('action', function ($index) {
            return view('admin.trial.datatable.action', compact('index'));
        });

        $dataTable->editColumn('name', function ($index) {
            return view('admin.trial.datatable.information', compact('index'));
        });


        $dataTable = $dataTable->rawColumns(['check', 'action', 'name'])->make(true);
        return $dataTable;
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $classSchedules = $this->classScheduleRepository->getIsTrial(1);

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
     * @param ParentTrial $parentTrial
     *
     * @return Factory|View
     */
    public function edit(ParentTrial $parentTrial)
    {
        return view('admin.trial.edit', compact('parentTrial'));
    }

    /**
     * @param ParentTrial        $parentTrial
     * @param UpdateTrialRequest $request
     * @param UpdateTrialAction  $action
     *
     * @return RedirectResponse
     */
    public function update(ParentTrial $parentTrial, UpdateTrialRequest $request, UpdateTrialAction $action)
    {
        $request->validated();

        $action->execute($parentTrial, $request->all());

        return redirect()->route('admin.trial.index')->with('success', 'Data has been updated');
    }

    /**
     * @param ParentTrial       $parentTrial
     * @param DeleteTrialAction $action
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(ParentTrial $parentTrial, DeleteTrialAction $action)
    {
        $action->execute($parentTrial);

        return redirect()->route('admin.trial.index')->with('success', 'Data has been deleted');
    }

    /**
     * @param ParentTrial $parentTrial
     *
     * @return Factory|View
     */
    public function createChild(ParentTrial $parentTrial)
    {
        $classSchedules = $this->classScheduleRepository->getIsTrial(1);

        return view('admin.trial.child.create', compact('parentTrial', 'classSchedules'));
    }

    /**
     * @param ParentTrial            $parentTrial
     * @param StoreChildTrialRequest $request
     * @param StoreChildTrialAction  $action
     *
     * @return RedirectResponse
     */
    public function storeChild(ParentTrial $parentTrial, StoreChildTrialRequest $request, StoreChildTrialAction $action)
    {
        $request->validated();

        $action->execute($parentTrial, $request->all());

        return redirect()->route('admin.trial.edit', $parentTrial)->with('success', 'Data has been added!');
    }

    /**
     * @param ParentTrial $parentTrial
     * @param ChildTrial  $childTrial
     *
     * @return Factory|View
     */
    public function editChild(ParentTrial $parentTrial, ChildTrial $childTrial)
    {
        $classSchedules = $this->classScheduleRepository->getIsTrial(1);

        return view('admin.trial.child.edit', compact('parentTrial', 'childTrial', 'classSchedules'));
    }

    /**
     * @param ParentTrial             $parentTrial
     * @param ChildTrial              $childTrial
     * @param UpdateChildTrialRequest $request
     * @param UpdateChildTrialAction  $action
     *
     * @return RedirectResponse
     */
    public function updateChild(ParentTrial $parentTrial, ChildTrial $childTrial, UpdateChildTrialRequest $request, UpdateChildTrialAction $action)
    {
        $request->validated();

        $action->execute($childTrial, $request->all());

        return redirect()->route('admin.trial.edit', $parentTrial)->with('success', 'Data has been updated!');
    }

    /**
     * @param ParentTrial            $parentTrial
     * @param ChildTrial             $childTrial
     * @param DeleteChildTrialAction $action
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function deleteChild(ParentTrial $parentTrial, ChildTrial $childTrial, DeleteChildTrialAction $action)
    {
        $action->execute($childTrial);

        return redirect()->route('admin.trial.edit', $parentTrial)->with('success', 'Data has been deleted!');
    }
}
