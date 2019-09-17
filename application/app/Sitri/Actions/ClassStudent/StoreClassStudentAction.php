<?php


namespace App\Sitri\Actions\ClassStudent;


use App\Sitri\Models\Admin\ClassSchedule;
use App\Sitri\Models\Admin\ClassStudent;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class StoreClassStudentAction
{
    /**
     * @param array $request
     *
     * @return Builder|Model
     * @throws Exception
     */
    public function execute(array $request)
    {
        $checks = ClassStudent::query()->whereIn('class_schedule_id', $request['class_schedule_id'])
                              ->where('student_id', $request['student_id'])->get()
        ;

        $listScheduleRegister = [];
        foreach ($checks as $classSchedule) {
            $listScheduleRegister[$classSchedule->student_id][$classSchedule->class_schedule_id] = true;
        }

        $massInsert = [];
        foreach ($request['class_schedule_id'] as $classStudentId) {
            if (isset($listScheduleRegister[$request['student_id']][$classStudentId])) {
                continue;
            }

            $massInsert[] = [
                'student_id'        => $request['student_id'],
                'class_schedule_id' => $classStudentId,
            ];
        }

        if (0 === count($massInsert)) {
            throw new Exception('Nothing to add schedule');
        }

        return ClassStudent::query()->insert($massInsert);
    }
}
