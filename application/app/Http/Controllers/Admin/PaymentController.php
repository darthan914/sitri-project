<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\General\ActiveRequest;
use App\Http\Requests\Admin\Payment\IndexPaymentRequest;
use App\Http\Requests\Admin\Payment\StorePaymentRequest;
use App\Http\Requests\Admin\Payment\UpdatePaymentRequest;
use App\Sitri\Actions\Payment\DeletePaymentAction;
use App\Sitri\Actions\Payment\PayPaymentAction;
use App\Sitri\Actions\Payment\StorePaymentAction;
use App\Sitri\Actions\Payment\UpdatePaymentAction;
use App\Sitri\Models\Admin\Payment;
use App\Sitri\Repositories\Payment\PaymentRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Sitri\Repositories\Student\StudentRepositoryInterface;
use Exception;
use Illuminate\Contracts\View\Factory;
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
     * PaymentController constructor.
     *
     * @param PaymentRepositoryInterface $paymentRepository
     * @param StudentRepositoryInterface $studentRepository
     */
    public function __construct(
        PaymentRepositoryInterface $paymentRepository,
        StudentRepositoryInterface $studentRepository
    ) {
        $this->middleware('auth');
        $this->paymentRepository = $paymentRepository;
        $this->studentRepository = $studentRepository;
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

        $dataTable = Datatables::of($this->paymentRepository->getByRequest($request->all()));

        $dataTable->addColumn('action', function ($index) {
            return view('admin.payment.datatable.action', compact('index'));
        });

        $dataTable->editColumn('student_id', function ($payment) {
            return $payment->student->name . ' - ' . $payment->student->user->name;
        });

        $dataTable->editColumn('value', function ($payment) {
            return 'Rp. ' . number_format($payment->value);
        });

        $dataTable->editColumn('date_paid', function ($payment) {
            return view('admin.payment.datatable.paid', compact('payment'));
        });

        $dataTable = $dataTable->rawColumns(['action', 'date_paid'])->make(true);
        return $dataTable;
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $students = $this->studentRepository->all();
        return view('admin.payment.create', compact('students'));
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
     * @param Payment $payment
     *
     * @return Factory|View
     */
    public function edit(Payment $payment)
    {
        return view('admin.payment.edit', compact('payment'));
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
            $action->execute($payment, $request->value);
        } catch (Exception $e) {
            return redirect()->route('admin.payment.index')->with('failed', $e->getMessage());
        }

        return redirect()->route('admin.payment.index')->with('success', 'Data has been updated');
    }

    public function delete(Payment $payment, DeletePaymentAction $action)
    {
        try {
            $action->execute($payment);
        } catch (Exception $e) {
            return redirect()->route('admin.payment.index')->with('failed', $e->getMessage());
        }

        return redirect()->route('admin.payment.index')->with('success', 'Data has been updated');
    }

    /**
     * @param Payment          $payment
     * @param ActiveRequest    $request
     * @param PayPaymentAction $action
     *
     * @return RedirectResponse
     */
    public function paid(Payment $payment, ActiveRequest $request, PayPaymentAction $action)
    {
        $request->validate();

        try {
            $action->execute($payment, $request->active);
        } catch (Exception $e) {
            return redirect()->route('admin.payment.index')->with('failed', $e->getMessage());
        }

        return redirect()->route('admin.payment.index')->with('success', 'Data has been updated');
    }
}
