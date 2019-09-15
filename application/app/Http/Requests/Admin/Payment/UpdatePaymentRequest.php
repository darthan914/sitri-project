<?php

namespace App\Http\Requests\Admin\Payment;


class UpdatePaymentRequest extends StorePaymentRequest
{
    public function rules()
    {
        return ['value' => 'required|numeric'];
    }
}
