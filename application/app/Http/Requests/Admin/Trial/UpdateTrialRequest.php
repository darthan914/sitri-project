<?php

namespace App\Http\Requests\Admin\Trial;

class UpdateTrialRequest extends StoreTrialRequest
{
    public function rules()
    {
        $rules = parent::rules();
        $rules['name'] = ['required'];

        unset($rules['name.*' ]);
        unset($rules['class_schedule_id.*']);

        return $rules;
    }
}
