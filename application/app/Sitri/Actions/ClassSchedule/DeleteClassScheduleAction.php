<?php


namespace App\Sitri\Actions\ClassSchedule;


use App\Sitri\Models\Admin\ClassSchedule;
use Exception;

class DeleteClassScheduleAction
{
    /**
     * @param int $classScheduleId
     *
     * @return bool
     * @throws Exception
     */
    public function execute($classScheduleId)
    {
        return ClassSchedule::query()->find($classScheduleId)->delete();
    }
}
