<?php


namespace App\Sitri\Actions\Payment;


use App\Sitri\Models\Admin\Payment;
use Exception;

class StorePaymentAction
{
    /**
     * @param array $request
     *
     * @return bool
     * @throws Exception
     */
    public function execute(array $request)
    {
        $noPayment = Payment::query()
                           ->where('no_payment', 'like', $request['code'] . '%')
                           ->orderBy('no_payment', 'desc')->first();

        $startNum = intval(substr($noPayment->no_payment ?? 0, -3, 3)) + 1;

        $massInsert = [];
        foreach ($request['check'] as $key => $student) {
            if('' !== $request['value'][$key]) {
                $massInsert[] = [
                    'no_payment' => $request['code'] . str_pad($startNum++, 3, '0', STR_PAD_LEFT),
                    'student_id' => $key,
                    'value'      => $request['value'][$key],
                ];
            }
        }

        Payment::query()->insert($massInsert);

        return true;
    }
}
