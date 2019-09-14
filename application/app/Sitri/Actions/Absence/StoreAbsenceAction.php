<?php


namespace App\Sitri\Actions\Absence;


use App\Sitri\Models\Admin\Absence;
use App\Sitri\Models\Admin\AbsenceDetail;
use App\Sitri\Repositories\Absence\AbsenceRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class StoreAbsenceAction
{
    /**
     * @param array $request
     *
     * @return Builder|Model
     * @throws Exception
     */
    public function execute(array $request)
    {
        $check = Absence::query()
                        ->where('class_schedule_id', $request['class_schedule_id'])
                        ->where('date', $request['date'])
                        ->count()
        ;

        if($check > 0) {
            throw new Exception('Absence already saved.');
        }

        $absenceInsert = [
            'class_schedule_id' => $request['class_schedule_id'],
            'date'              => $request['date'],
        ];

        $absence = Absence::query()->create($absenceInsert);

        $massInsert = [];
        foreach ($request['status'] as $key => $list) {
            $massInsert[] = [
                'absence_id' => $absence->id,
                'student_id' => $key,
                'status'     => $list,
            ];
        }

        AbsenceDetail::query()->insert($massInsert);

        return $absence;
    }
}
