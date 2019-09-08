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
        $check = ClassStudent::query()->where('class_schedule_id', $request['class_schedule_id'])
                                       ->where('student_id', $request['student_id'])->first()
        ;

        if (isset($check)) {
            throw new Exception('Class student already exist');
        }

        return ClassStudent::query()->create($request);
    }
}
