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
        $checkClassRoom = ClassSchedule::query()->where('class_room_id', $request['class_room_id'])
                                       ->where('schedule_id', $request['schedule_id'])
                                       ->where('id', '<>', $classSchedule->id)->first()
        ;

        if (isset($checkClassRoom)) {
            throw new Exception('Class schedule already exist');
        }

        return $classSchedule->update($request);
    }
}
