<?php


namespace App\Sitri\Actions\Payment;


use App\Sitri\Models\Admin\Payment;
use Carbon\Carbon;
use Exception;

class PayPaymentAction
{
    /**
     * @param int $paymentId
     *
     * @return bool
     * @throws Exception
     */
    public function execute($paymentId, $paid)
    {
        $payment = Payment::query()->find($paymentId);

        if ($payment->date_paid && $paid) {
            throw new Exception('Data has been paid.');
        }

        if ($paid) {
            $payment->update(['date_paid' => Carbon::now()->toDateString()]);
        } else {
            $payment->update(['date_paid' => null]);
        }

        return true;
    }
}
