<?php


namespace App\Sitri\Actions\Payment;


use App\Sitri\Models\Admin\Payment;

class UpdatePaymentAction
{
    public function execute(Payment $payment, array $request)
    {
        $payment->update($request);

        return true;
    }
}
