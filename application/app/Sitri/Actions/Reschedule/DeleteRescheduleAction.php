<?php


namespace App\Sitri\Actions\Reschedule;


use App\Sitri\Models\Admin\Reschedule;
use Exception;

class DeleteRescheduleAction
{
    /**
     * @param Reschedule $reschedule
     *
     * @return bool
     * @throws Exception
     */
    public function execute(Reschedule $reschedule)
    {
        return $reschedule->delete();
    }
}
