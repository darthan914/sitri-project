<?php

namespace App\Http\Requests\Admin\Payment;


class UpdatePaymentRequest extends StorePaymentRequest
{
    public function rules()
    {
        $validation = parent::rules();
        unset($validation['no_payment']);
        unset($validation['student_id']);

        return $validation;
    }
}
