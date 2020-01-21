<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\General\ActiveDateRequest;
use App\Http\Requests\Admin\General\ActiveRequest;
use App\Http\Requests\Admin\Payment\IndexPaymentRequest;
use App\Http\Requests\Admin\Payment\StorePaymentRequest;
use App\Http\Requests\Admin\Payment\UpdatePaymentRequest;
use App\Sitri\Actions\Payment\DeletePaymentAction;
use App\Sitri\Actions\Payment\PayPaymentAction;
use App\Sitri\Actions\Payment\StorePaymentAction;
use App\Sitri\Actions\Payment\UpdatePaymentAction;
use App\Sitri\Models\Admin\Payment;
use App\Sitri\Repositories\Item\ItemRepositoryInterface;
use App\Sitri\Repositories\Payment\PaymentRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Sitri\Repositories\Setting\SettingRepositoryInterface;
use App\Sitri\Repositories\Student\StudentRepositoryInterface;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class PaymentController extends Controller
{
    /**
     * @var PaymentRepositoryInterface
     */
    private $paymentRepository;
    /**
     * @var StudentRepositoryInterface
     */
    private $studentRepository;
    /**
     * @var ItemRepositoryInterface
     */
    private $itemRepository;
    /**
     * @var SettingRepositoryInterface
     */
    private $settingRepository;


    /**
     * PaymentController constructor.
     *
     * @param PaymentRepositoryInterface $paymentRepository
     * @param StudentRepositoryInterface $studentRepository
     * @param ItemRepositoryInterface    $itemRepository
     * @param SettingRepositoryInterface $settingRepository
     */
    public function __construct(
        PaymentRepositoryInterface $paymentRepository,
        StudentRepositoryInterface $studentRepository,
        ItemRepositoryInterface $itemRepository,
        SettingRepositoryInterface $settingRepository
    ) {
        $this->paymentRepository = $paymentRepository;
        $this->studentRepository = $studentRepository;
        $this->itemRepository = $itemRepository;
        $this->settingRepository = $settingRepository;
    }

    /**
     * @param IndexPaymentRequest $request
     *
     * @return Factory|View
     */
    public function index(IndexPaymentRequest $request)
    {
        $request->validated();

        return view('admin.payment.index', compact('request'));
    }

    /**
     * @param IndexPaymentRequest $request
     *
     * @return mixed
     * @throws Exception
     */
    public function dataTable(IndexPaymentRequest $request)
    {
        $request->validated();

        $payments = $this->paymentRepository->getByRequest($request->all(), ['student']);

        $dataTable = Datatables::of($payments);

        $dataTable->addColumn('action', function ($payment) {
            return view('admin.payment.datatable.action', compact('payment'));
        });

        $dataTable->editColumn('total', function ($payment) {
            return 'Rp. ' . number_format($payment['total']);
        });

        $dataTable = $dataTable->make(true);
        return $dataTable;
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $students = $this->studentRepository->all();
        $months = config('sitri.month');
        $multiple_months = config('sitri.multiple_month');
        $items = $this->itemRepository->all();
        $cost = $this->settingRepository->getCost();

        return view('admin.payment.create', compact('students', 'months', 'multiple_months', 'items', 'cost'));
    }

    /**
     * @param StorePaymentRequest $request
     * @param StorePaymentAction  $action
     *
     * @return RedirectResponse
     */
    public function store(StorePaymentRequest $request, StorePaymentAction $action)
    {
        $request->validated();

        try {
            $action->execute($request->all());
        } catch (Exception $e) {
            return redirect()->route('admin.payment.index')->with('failed', $e->getMessage());
        }

        return redirect()->route('admin.payment.index')->with('success', 'Data has been added');
    }

    /**
     * @param int $id
     *
     * @return Factory|View
     */
    public function edit($id)
    {
        $payment = $this->paymentRepository->find($id, ['student']);
        $students = $this->studentRepository->all();
        $months = config('sitri.month');
        $multiple_months = config('sitri.multiple_month');
        $items = $this->itemRepository->all();

        return view('admin.payment.edit', compact('payment', 'students', 'months', 'multiple_months', 'items'));
    }

    /**
     * @param Payment              $payment
     * @param UpdatePaymentRequest $request
     * @param UpdatePaymentAction  $action
     *
     * @return RedirectResponse
     */
    public function update(Payment $payment, UpdatePaymentRequest $request, UpdatePaymentAction $action)
    {
        $request->validated();

        try {
            $action->execute($payment, $request->all());
        } catch (Exception $e) {
            return redirect()->route('admin.payment.index')->with('failed', $e->getMessage());
        }

        return redirect()->route('admin.payment.index')->with('success', 'Data has been updated');
    }

    /**
     * @param int                 $id
     * @param DeletePaymentAction $action
     *
     * @return JsonResponse
     */
    public function delete($id, DeletePaymentAction $action)
    {
        try {
            $action->execute($id);
        } catch (Exception $e) {
            return response()->json(['messages' => $e->getMessage()]);
        }

        return response()->json(['messages' => 'Data has been deleted!']);
    }

    /**
     * @param int              $id
     * @param ActiveRequest    $request
     * @param PayPaymentAction $action
     *
     * @return JsonResponse
     */
    public function paid($id, ActiveDateRequest $request, PayPaymentAction $action)
    {
        $request->validate();

        try {
            $action->execute($id, $request->active, $request->date);
        } catch (Exception $e) {
            return response()->json(['messages' => $e->getMessage()]);
        }

        return response()->json(['messages' => 'Data has been updated!']);
    }
}
