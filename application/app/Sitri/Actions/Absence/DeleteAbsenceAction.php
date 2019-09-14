<?php


namespace App\Sitri\Actions\Absence;


use App\Sitri\Models\Admin\Absence;
use Exception;

class DeleteAbsenceAction
{
    /**
     * @param Absence $absence
     *
     * @return bool
     * @throws Exception
     */
    public function execute(Absence $absence)
    {
        $absence->absenceDetails()->delete();
        $absence->delete();

        return true;
    }
}
