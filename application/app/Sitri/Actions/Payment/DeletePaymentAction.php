<?php


namespace App\Sitri\Actions\Payment;


use App\Sitri\Models\Admin\Payment;
use Exception;

class DeletePaymentAction
{
    /**
     * @param Payment $payment
     *
     * @return bool
     * @throws Exception
     */
    public function execute(Payment $payment)
    {
        $payment->delete();

        return true;
    }
}
