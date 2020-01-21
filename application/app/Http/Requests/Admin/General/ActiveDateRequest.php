<?php

namespace App\Http\Requests\Admin\General;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property bool active
 * @property string date
 */
class ActiveDateRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        if (!isset($this->date)) {
            $this->merge(['date' => Carbon::now()->toDateString()]);
        }
    }
}
