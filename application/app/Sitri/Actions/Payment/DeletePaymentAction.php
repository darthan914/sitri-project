<?php


namespace App\Sitri\Actions\Payment;


use App\Sitri\Models\Admin\Payment;
use Exception;

class DeletePaymentAction
{
    /**
     * @param int $paymentId
     *
     * @return bool
     * @throws Exception
     */
    public function execute($paymentId)
    {
        Payment::query()->find($paymentId)->delete();

        return true;
    }
}
