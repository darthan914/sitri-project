<?php


namespace App\Sitri\Actions\ClassSchedule;


use App\Sitri\Models\Admin\ClassSchedule;
use Exception;

class UpdateClassScheduleAction
{
    /**
     * @param array $request
     *
     * @return bool
     * @throws Exception
     */
    public function execute(array $request)
    {
        ClassSchedule::query()->updateOrCreate(
            [
                'class_room_id' => $request['class_room_id'],
                'schedule_id'   => $request['schedule_id']
            ],
            [
                'is_trial' => isset($request['is_trial']) ? 1 : 0,
                'active'   => isset($request['active']) ? 1 : 0,
            ]
        )
        ;

        return true;
    }
}
