<?php


namespace App\Sitri\Actions\ClassSchedule;


use App\Sitri\Models\Admin\ClassSchedule;

class ActiveClassScheduleAction
{
    /**
     * @param ClassSchedule $classSchedule
     * @param               $active
     *
     * @return bool
     */
    public function execute(ClassSchedule $classSchedule, $active)
    {
        return $classSchedule->update(['active' => $active]);
    }
}
