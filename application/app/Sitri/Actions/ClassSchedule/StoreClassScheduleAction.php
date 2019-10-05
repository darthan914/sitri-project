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
     * @return Builder|Model
     * @throws Exception
     */
    public function execute(array $request)
    {
        if(isset($request['time'])) {
            $request['start_time'] = config('sitri.time')[$request['time']]['start_time'];
            $request['end_time'] = config('sitri.time')[$request['time']]['end_time'];
        }


        $checkClassRoom = ClassSchedule::query()->where('class_room_id', $request['class_room_id'])
                                       ->where('day', $request['day'])
                                       ->where('start_time', $request['start_time'])
                                       ->where('end_time', $request['end_time'])
                                       ->first()
        ;

        if (isset($checkClassRoom)) {
            throw new Exception('Class schedule already exist');
        }

        return ClassSchedule::query()->create($request);
    }
}
