<?php


namespace App\Sitri\Actions\ClassSchedule;


use App\Sitri\Models\Admin\ClassSchedule;
use Exception;

class DeleteClassScheduleAction
{
    /**
     * @param ClassSchedule $classSchedule
     *
     * @return bool
     * @throws Exception
     */
    public function execute(ClassSchedule $classSchedule)
    {
        $classSchedule->delete();

        return true;
    }
}
