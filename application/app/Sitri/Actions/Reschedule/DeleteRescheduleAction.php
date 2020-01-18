<?php


namespace App\Sitri\Actions\Reschedule;


use App\Sitri\Models\Admin\Reschedule;
use Exception;

class DeleteRescheduleAction
{
    /**
     * @param int $rescheduleId
     *
     * @return bool
     * @throws Exception
     */
    public function execute($rescheduleId)
    {
        return Reschedule::query()->find($rescheduleId)->delete();
    }
}
