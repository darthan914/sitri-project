<?php


namespace App\Sitri\Repositories\Payment;


use App\Sitri\Models\Admin\ClassSchedule;
use App\Sitri\Models\Admin\Payment;
use App\Sitri\Models\Admin\Schedule;
use App\Sitri\Models\Admin\Student;
use Carbon\Carbon;

class PaymentRepository implements PaymentRepositoryInterface
{

    /**
     * @param array $with
     *
     * @return array
     */
    public function all(array $with = [])
    {
        return Payment::query()->with($with)->orderBy('updated_at', 'DESC')->get()->toArray();
    }

    /**
     * @param int   $id
     * @param array $with
     *
     * @return array
     */
    public function find($id, array $with = [])
    {
        return Payment::query()->with($with)->find($id)->toArray();
    }

    /**
     * @param array $request
     * @param array $with
     *
     * @return array
     */
    public function getByRequest(array $request, array $with = [])
    {
        $collect = collect($request);
        $payment = Payment::query()->with($with);

        $paid = $collect->get('f_paid');
        if (null !== $paid) {
            if (!!$paid) {
                $payment->whereNotNull('date_paid');
            } else {
                $payment->whereNull('date_paid');
            }
        }

        $search = $collect->get('f_search');
        if (null !== $search) {
            $payment->where(function ($payment) use ($search) {
                $payment->where('no_payment', 'like', '%' . $search . '%')
                        ->orWhereHas('student', function ($student) use ($search) {
                            $student->where('name', 'like', '%' . $search . '%')
                                    ->orWhereHas('user', function ($user) use ($search) {
                                        $user->where('name', 'like', '%' . $search . '%');
                                    })
                            ;
                        })
                ;
            });
        }

        $student = $collect->get('f_student');
        if (null !== $student) {
            $payment->where('student_id', $student);
        }

        return $payment->get()->toArray();
    }

    /**
     * @inheritDoc
     */
    public function generateNoPayment()
    {
        $month = strtoupper(Carbon::now()->format('M'));

        $payment = Payment::query()->select('no_payment')
                          ->where('no_payment', 'like',
                              $month . "/%")
                          ->orderBy('no_payment', 'desc')
                          ->get()
        ;

        $number = 0;
        if ($payment->count() > 0) {
            $number = intval(substr($payment[0]->no_payment, -3, 3));
        }

        return $month . "/" . str_pad($number + 1, 3, '0', STR_PAD_LEFT);
    }

    /**
     * @param int $studentId
     * @param int $year
     * @param int $month
     *
     * @return string
     */
    public function getStatusPaymentDate($studentId, $year = null, $month = null)
    {
        if(null === $year) {
            $year = Carbon::now()->year;
        }

        if(null === $month) {
            $month = Carbon::now()->month;
        }

        $payments = Payment::query()->where('student_id', $studentId)
                           ->whereNotNull('date_paid')
                           ->where('use_monthly', 1)
                           ->where('year', $year)
                           ->get()
        ;

        foreach ($payments as $payment) {
            if ($payment->isPaidRangeMonth($year, $month)) {
                return $payment->date_paid;
            }
        }

        return '';
    }
}
