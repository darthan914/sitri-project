<?php

namespace App\Http\Requests\Admin\Absence;

use Illuminate\Foundation\Http\FormRequest;

class StoreAbsenceRequest extends FormRequest
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
            'class_schedule_id' => 'required|integer',
            'date'              => 'required|date',
            'status'            => 'min:1',
            'status.*'          => 'required',
        ];
    }
}
