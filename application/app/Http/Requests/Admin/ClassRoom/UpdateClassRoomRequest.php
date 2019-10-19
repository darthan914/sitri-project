<?php

namespace App\Http\Requests\Admin\ClassRoom;


use Illuminate\Validation\Rule;

class UpdateClassRoomRequest extends StoreClassRoomRequest
{
    public function rules()
    {
        $rules = parent::rules();
        $rules['name'] = 'required|unique:class_rooms,name,'.$this->route('classRoom')->id;

        return $rules;
    }
}
