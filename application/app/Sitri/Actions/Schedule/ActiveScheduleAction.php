<?php


namespace App\Sitri\Actions\Schedule;


use App\Sitri\Models\Admin\Schedule;

class ActiveScheduleAction
{
    /**
     * @param Schedule $schedule
     * @param          $active
     *
     * @return bool
     */
    public function execute(Schedule $schedule, $active)
    {
        return $schedule->update(['active' => $active]);
    }
}
