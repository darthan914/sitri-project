<?php

namespace App\Http\Requests\Admin\ClassRoom;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassRoomRequest extends FormRequest
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
            'name'   => 'required|unique:class_rooms',
            'max_student'   => 'required|integer',
            'active' => 'nullable|boolean',
        ];
    }

    protected function prepareForValidation()
    {
        if(!isset($this->active)) {
            $this->active = 0;
        }
    }
}
