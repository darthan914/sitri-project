<?php


namespace App\Sitri\Actions\ClassSchedule;


use App\Sitri\Models\Admin\ClassSchedule;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class StoreClassScheduleAction
{
    /**
     * @param array $request
     *
     * @return array
     */
    public function execute(array $request)
    {

        return ClassSchedule::query()->updateOrCreate(
            [
                'class_room_id' => $request['class_room_id'],
                'schedule_id'   => $request['schedule_id']
            ],
            [
                'teacher_name' => $request['teacher_name'],
                'is_trial'     => isset($request['is_trial']) ? 1 : 0,
                'id_active'    => isset($request['teacher_name']) ? 1 : 0,
            ]
        )->toArray()
        ;
    }
}
