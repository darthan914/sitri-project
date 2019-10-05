<?php


namespace App\Http\Requests\Admin\Trial;


use Illuminate\Foundation\Http\FormRequest;

class StoreChildTrialRequest extends FormRequest
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
            'name'              => ['required'],
            'class_schedule_id' => ['required'],
            'age' => ['nullable', 'integer'],
        ];
    }
}
