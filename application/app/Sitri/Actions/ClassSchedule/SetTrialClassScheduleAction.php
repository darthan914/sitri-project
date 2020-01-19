<?php


namespace App\Sitri\Actions\ClassSchedule;


use App\Sitri\Models\Admin\ClassSchedule;

class SetTrialClassScheduleAction
{
    /**
     * @param int  $classScheduleId
     * @param bool $setTrial
     *
     * @return bool
     */
    public function execute($classScheduleId, $setTrial)
    {
        return ClassSchedule::query()->find($classScheduleId)->update(['is_trial' => $setTrial]);
    }
}
