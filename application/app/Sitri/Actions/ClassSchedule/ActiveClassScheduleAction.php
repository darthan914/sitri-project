<?php


namespace App\Sitri\Actions\ClassSchedule;


use App\Sitri\Models\Admin\ClassSchedule;

class ActiveClassScheduleAction
{
    /**
     * @param ClassSchedule $classSchedule
     * @param          $active
     *
     * @return ClassSchedule
     */
    public function execute(ClassSchedule $classSchedule, $active)
    {
        $classSchedule->active = $active;
        $classSchedule->save();

        return $classSchedule;
    }
}
