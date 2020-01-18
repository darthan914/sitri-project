<?php

namespace App\Http\Requests\Admin\General;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property bool active
 */
class ActiveRequest extends FormRequest
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
            'active' => 'required|boolean',
        ];
    }
}
