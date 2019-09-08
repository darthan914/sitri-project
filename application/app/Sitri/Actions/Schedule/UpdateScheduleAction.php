<?php


namespace App\Sitri\Actions\Schedule;


use App\Sitri\Models\Admin\Schedule;

class UpdateScheduleAction
{
    /**
     * @param Schedule $schedule
     * @param array    $request
     *
     * @return bool
     */
    public function execute(Schedule $schedule, array $request)
    {
        return $schedule->update($request);
    }
}
