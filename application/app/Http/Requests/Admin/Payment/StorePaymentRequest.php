<?php

namespace App\Http\Requests\Admin\Payment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

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
            'student_id' => 'required',

            'register_value' => 'required_with:use_registration|numeric',
            'type_month_payment' => 'required_if:use_monthly,1',
            'one_month_month' => 'required_if:type_month_payment,ONE_MONTH',
            'three_month_month' => 'required_if:type_month_payment,THREE_MONTH',
            'day_off_month' => 'required_if:type_month_payment,DAY_OFF',

            'one_month_value' => 'numeric',
            'three_month_value' => 'numeric',
            'day_off_value' => 'numeric',

            'item.*'     => 'required_if:use_shopping,1',
            'quantity.*' => 'required_if:use_shopping,1|integer',
        ];
    }

    protected function prepareForValidation()
    {
        if (!isset($this->use_registration)) {
            $this->merge(['use_registration' => 0]);
        }

        if (!isset($this->use_monthly)) {
            $this->merge(['use_monthly' => 0]);
        }

        if (!isset($this->use_shopping)) {
            $this->merge(['use_shopping' => 0]);
        }

        $this->merge([
            'register_value'    => str_replace(',', '', $this->register_value),
            'one_month_value'   => str_replace(',', '', $this->one_month_value),
            'three_month_value' => str_replace(',', '', $this->three_month_value),
            'day_off_value'     => str_replace(',', '', $this->day_off_value),
        ]);
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function (Validator $validator) {
            if (isset($this->use_monthly) && 'ONE_MONTH' == $this->type_payment && '' == $this->one_month_month) {
                $validator->errors()->add('one_month_month', 'Month is required!');
            }

            if (isset($this->use_monthly) && 'THREE_MONTH' == $this->type_payment && '' == $this->three_month_month) {
                $validator->errors()->add('three_month_month', 'Month is required!');
            }

            if (isset($this->use_monthly) && 'DAY_OFF' == $this->type_payment && '' == $this->day_off_month) {
                $validator->errors()->add('day_off_month', 'Month is required!');
            }
        });
    }
}
