<?php

namespace App\Http\Requests\Admin\Item;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends StoreItemRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = Parent::rules();
        $rules['name'] = ['required', Rule::unique('users')->ignore($this->id)];

        return $rules;
    }
}
