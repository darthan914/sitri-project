<?php

namespace App\Http\Requests\Admin\Auth;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class SendForgotPasswordRequest extends FormRequest
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
            'email' => 'required'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $check = User::query()->where('email', $this->email)->get()->count();

            if ($check == 0) {
                $validator->errors()->add('email', 'Email not on the list!');
            }
        });
    }
}
