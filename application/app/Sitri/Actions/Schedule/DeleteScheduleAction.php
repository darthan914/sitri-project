<?php


namespace App\Sitri\Actions\Schedule;


use App\Sitri\Models\Admin\Schedule;
use Exception;

class DeleteScheduleAction
{
    /**
     * @param int $scheduleId
     *
     * @return bool
     * @throws Exception
     */
    public function execute($scheduleId)
    {
        return Schedule::query()->find($scheduleId)->delete();
    }
}
