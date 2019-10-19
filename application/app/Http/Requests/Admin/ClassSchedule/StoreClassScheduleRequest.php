<?php

namespace App\Http\Requests\Admin\ClassSchedule;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassScheduleRequest extends FormRequest
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
            'class_room_id' => 'required|integer',
            'day'           => 'required|integer',
            'time'          => 'required|integer',
            'active'        => 'nullable|boolean',
            'is_trial'      => 'nullable|boolean',
            'teacher_name'  => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'class_room_id' => 'class room',
        ];
    }
}
