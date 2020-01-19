<?php


namespace App\Sitri\Actions\ClassSchedule;


use App\Sitri\Models\Admin\ClassSchedule;

class ActiveClassScheduleAction
{
    /**
     * @param int  $classScheduleId
     * @param bool $active
     *
     * @return bool
     */
    public function execute($classScheduleId, $active)
    {
        return ClassSchedule::query()->find($classScheduleId)->update(['active' => $active]);
    }
}
