<?php

namespace App\Http\Requests\Admin\Student;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends FormRequest
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
            'parent_email'  => ['required', 'email'],
            'parent_name'   => ['required'],
            'name'          => ['required'],
            'birthday'      => ['required', 'date'],
            'school'        => ['required'],
            'grade'         => ['required'],
            'age'           => ['required', 'integer'],
            'date_enter'    => ['required', 'date'],
            'class_room_id' => ['required', 'integer'],
            'schedule_id'   => ['required', 'integer'],
            'teacher_name'  => ['required'],
        ];
    }
}
