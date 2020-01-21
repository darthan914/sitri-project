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
}
