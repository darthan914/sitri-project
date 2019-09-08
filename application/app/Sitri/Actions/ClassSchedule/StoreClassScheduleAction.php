<?php


namespace App\Sitri\Actions\ClassSchedule;


use App\Sitri\Models\Admin\ClassSchedule;
use Exception;

class StoreClassScheduleAction
{
    /**
     * @param array $request
     *
     * @return ClassSchedule
     * @throws Exception
     */
    public function execute(array $request)
    {
        $checkClassRoom = ClassSchedule::query()->where('class_room_id', $request['class_room_id'])
                                       ->where('schedule_id', $request['schedule_id'])->first()
        ;

        if (isset($checkClassRoom)) {
            throw new Exception('Class schedule already exist');
        }


        $classSchedule = new ClassSchedule();

        $classSchedule->class_room_id = $request['class_room_id'];
        $classSchedule->schedule_id = $request['schedule_id'];
        $classSchedule->active = isset($request['active']) ? 1 : 0;

        $classSchedule->save();

        return $classSchedule;
    }
}
