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
        $checkClassRoom = ClassSchedule::query()->where('class_room_id', $request['class_room_id'])
                                       ->where('schedule_id', $request['schedule_id'])->first()
        ;

        if (isset($checkClassRoom)) {
            throw new Exception('Class schedule already exist');
        }

        return ClassSchedule::query()->create($request);
    }
}
