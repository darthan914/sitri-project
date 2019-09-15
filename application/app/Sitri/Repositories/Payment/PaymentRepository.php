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
     * @return mixed
     */
    public function all()
    {
        return Payment::query()->get();
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function getByRequest(array $data)
    {
        $collect = collect($data);
        $payment = Payment::query();
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

        return $payment->get();
    }
}
