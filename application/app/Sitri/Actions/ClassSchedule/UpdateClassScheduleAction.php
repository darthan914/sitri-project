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
        if (isset($request['time'])) {
            $request['start_time'] = config('sitri.time')[$request['time']]['start_time'];
            $request['end_time'] = config('sitri.time')[$request['time']]['end_time'];
        }


        $checkClassRoom = ClassSchedule::query()->where('class_room_id', $request['class_room_id'])
                                       ->where('day', $request['day'])
                                       ->where('start_time', $request['start_time'])
                                       ->where('end_time', $request['end_time'])
                                       ->where('id', '<>', $classSchedule->id)
                                       ->first()
        ;

        if (isset($checkClassRoom)) {
            throw new Exception('Class schedule already exist');
        }

        $request['active'] = isset($request['active']) ? 1 : 0;
        $request['is_trial'] = isset($request['is_trial']) ? 1 : 0;

        return $classSchedule->update($request);
    }
}
