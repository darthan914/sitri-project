<?php

namespace App\Http\Requests\Admin\Schedule;

use Illuminate\Foundation\Http\FormRequest;

class StoreScheduleRequest extends FormRequest
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
            'day'        => 'required|integer|in:' . implode(',', range(0, 6)),
            'start_time' => 'required',
            'end_time'   => 'required',
            'active'     => 'nullable|boolean',
        ];
    }
}
