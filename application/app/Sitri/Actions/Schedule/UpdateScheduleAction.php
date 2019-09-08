<?php


namespace App\Sitri\Actions\Schedule;


use App\Sitri\Models\Admin\Schedule;

class UpdateScheduleAction
{
    /**
     * @param Schedule $schedule
     * @param array    $request
     *
     * @return Schedule
     */
    public function execute(Schedule $schedule, array $request)
    {
        $schedule->day = $request['day'];
        $schedule->start_time = $request['start_time'];
        $schedule->end_time = $request['end_time'];
        $schedule->active = isset($request['active']) ? 1 : 0;

        $schedule->save();

        return $schedule;
    }
}
