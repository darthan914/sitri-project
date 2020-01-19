<?php


namespace App\Sitri\Actions\Schedule;


use App\Sitri\Models\Admin\Schedule;

class UpdateScheduleAction
{
    /**
     * @param int $scheduleId
     * @param array    $request
     *
     * @return bool
     */
    public function execute($scheduleId, array $request)
    {
        return Schedule::query()->find($scheduleId)->update($request);
    }
}
