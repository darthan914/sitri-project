<?php


namespace App\Sitri\Actions\Absence;


use App\Sitri\Models\Admin\Absence;
use App\Sitri\Models\Admin\AbsenceDetail;
use App\Sitri\Repositories\Absence\AbsenceRepositoryInterface;
use Exception;

class UpdateAbsenceAction
{
    /**
     * @param int   $absenceId
     * @param array $request
     *
     * @return bool
     * @throws Exception
     */
    public function execute($absenceId, array $request)
    {
        Absence::query()->find($absenceId)->absenceDetails()->delete();

        $massInsert = [];
        foreach ($request['status'] as $key => $list) {
            $massInsert[] = [
                'absence_id' => $absenceId,
                'student_id' => $key,
                'status'     => $list,
            ];
        }

        AbsenceDetail::query()->insert($massInsert);

        return true;
    }
}
