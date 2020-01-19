<?php


namespace App\Sitri\Actions\Absence;


use App\Sitri\Models\Admin\Absence;
use Exception;

class DeleteAbsenceAction
{
    /**
     * @param $absenceId
     *
     * @return bool
     * @throws Exception
     */
    public function execute($absenceId)
    {
        Absence::query()->find($absenceId)->delete();

        return true;
    }
}
