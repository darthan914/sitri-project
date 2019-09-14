<?php

namespace App\Http\Requests\Admin\Absence;


class UpdateAbsenceRequest extends StoreAbsenceRequest
{
    public function rules()
    {
        $parent = parent::rules();
        unset($parent['date']);
        unset($parent['class_schedule_id']);

        return $parent;
    }
}
