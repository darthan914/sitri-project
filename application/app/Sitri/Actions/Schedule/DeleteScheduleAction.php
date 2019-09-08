<?php


namespace App\Sitri\Actions\Schedule;


use App\Sitri\Models\Admin\Schedule;
use Exception;

class DeleteScheduleAction
{
    /**
     * @param Schedule $schedule
     *
     * @return bool
     * @throws Exception
     */
    public function execute(Schedule $schedule)
    {
        return $schedule->delete();
    }
}
