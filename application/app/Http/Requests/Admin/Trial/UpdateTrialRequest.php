<?php

namespace App\Http\Requests\Admin\Trial;

class UpdateTrialRequest extends StoreTrialRequest
{
    public function rules()
    {
        $rules = parent::rules();

        unset($rules['child_name.*' ]);
        unset($rules['class_schedule_id.*']);

        return $rules;
    }
}
