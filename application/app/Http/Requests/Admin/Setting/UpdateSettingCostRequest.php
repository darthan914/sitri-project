<?php


namespace App\Http\Requests\Admin\Setting;


use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingCostRequest extends FormRequest
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
            'register'    => 'required|numeric',
            'one_month'   => 'required|numeric',
            'three_month' => 'required|numeric',
            'day_off'     => 'required|numeric',
        ];
    }
    
    protected function prepareForValidation()
    {
        $this->merge([
            'register'    => str_replace(',', '', $this->register),
            'one_month'   => str_replace(',', '', $this->one_month),
            'three_month' => str_replace(',', '', $this->three_month),
            'day_off'     => str_replace(',', '', $this->day_off),
        ]);
    }
}
