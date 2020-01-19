<?php

namespace App\Http\Requests\Admin\Item;

use App\Http\Requests\Admin\RegisterRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreItemRequest extends FormRequest
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
            'name' => [
                'required',
                Rule::unique('users'),
            ],
            'value' => ['required', 'numeric'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['value' => str_replace(',', '', $this->value)]);
    }
}
