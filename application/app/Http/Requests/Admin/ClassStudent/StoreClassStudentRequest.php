<?php

namespace App\Http\Requests\Admin\ClassStudent;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassStudentRequest extends FormRequest
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
            'class_schedule_id' => 'required|min:1',
            'student_id'        => 'required|integer',
        ];
    }

    public function attributes()
    {
        return [
            'class_schedule_id' => 'class schedule',
            'student_id'        => 'student',
        ];
    }
}
