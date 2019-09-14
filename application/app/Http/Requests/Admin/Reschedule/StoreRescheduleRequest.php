<?php

namespace App\Http\Requests\Admin\Reschedule;

use Illuminate\Foundation\Http\FormRequest;

class StoreRescheduleRequest extends FormRequest
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
            'student_id'             => 'required|integer',
            'from_date'              => 'required|date',
            'to_date'                => 'required|date',
            'from_class_schedule_id' => 'required|integer',
            'to_class_schedule_id'   => 'required|integer',
        ];
    }
}
