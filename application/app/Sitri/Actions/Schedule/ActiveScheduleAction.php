<?php


namespace App\Sitri\Actions\Schedule;


use App\Sitri\Models\Admin\Schedule;

class ActiveScheduleAction
{
    /**
     * @param Schedule $schedule
     * @param          $active
     *
     * @return Schedule
     */
    public function execute(Schedule $schedule, $active)
    {
        $schedule->active = $active;
        $schedule->save();

        return $schedule;
    }
}
