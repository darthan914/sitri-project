<?php

namespace App\Http\Requests\Admin\Payment;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'no_payment' => 'required|unique:payments',
            'student_id' => 'required',
            'registration_value' => 'numeric',
            'monthly_value' => 'numeric',
            'day_off_value' => 'numeric',
            'shopping_value' => 'numeric',
        ];
    }
}
