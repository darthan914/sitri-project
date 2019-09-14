<?php


namespace App\Sitri\Actions\Absence;


use App\Sitri\Models\Admin\Absence;
use App\Sitri\Models\Admin\AbsenceDetail;
use App\Sitri\Repositories\Absence\AbsenceRepositoryInterface;
use Exception;

class UpdateAbsenceAction
{
    /**
     * @param Absence $absence
     * @param array      $request
     *
     * @return bool
     * @throws Exception
     */
    public function execute(Absence $absence, array $request)
    {
        $absence->absenceDetails()->delete();

        $massInsert = [];
        foreach ($request['status'] as $key => $list) {
            $massInsert[] = [
                'absence_id' => $absence->id,
                'student_id' => $key,
                'status' => $list,
            ];
        }

        AbsenceDetail::query()->insert($massInsert);

        return true;
    }
}
