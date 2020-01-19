<?php

namespace App\Http\Requests\Admin\Trial;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTrialRequest extends FormRequest
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
            'parent_name'         => ['required'],
            'parent_phone'        => ['required', 'min:7', 'max:14'],
            'parent_email'        => ['required', 'email'],
            'name.*'              => ['required'],
            'age.*'               => ['required', 'integer'],
            'teacher_name.*'      => ['required'],
            'class_schedule_id.*' => ['required'],
        ];
    }
}
