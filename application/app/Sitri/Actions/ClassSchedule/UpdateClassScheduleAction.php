<?php


namespace App\Sitri\Actions\ClassSchedule;


use App\Sitri\Models\Admin\ClassSchedule;
use Exception;

class UpdateClassScheduleAction
{
    /**
     * @param ClassSchedule $classSchedule
     * @param array         $request
     *
     * @return bool
     * @throws Exception
     */
    public function execute(ClassSchedule $classSchedule, array $request)
    {
        ClassSchedule::query()->updateOrCreate(
            [
                'class_room_id' => $request['class_room_id'],
                'schedule_id'   => $request['schedule_id']
            ],
            [
                'teacher_name' => $request['teacher_name'],
                'is_trial'     => isset($request['is_trial']) ? 1 : 0,
                'id_active'    => isset($request['teacher_name']) ? 1 : 0,
            ]
        )
        ;

        return true;
    }
}
