<?php


namespace App\Sitri\Actions\ClassStudent;


use App\Sitri\Models\Admin\ClassStudent;
use Exception;

class UpdateClassStudentAction
{
    /**
     * @param int   $classStudentId
     * @param array $request
     *
     * @return bool
     * @throws Exception
     */
    public function execute($classStudentId, array $request)
    {
        $check = ClassStudent::query()->where('class_schedule_id', $request['class_schedule_id'])
                             ->where('student_id', $request['student_id'])
                             ->where('id', '<>', $classStudentId)->first()
        ;

        if (isset($check)) {
            throw new Exception('Class student already exist');
        }

        return ClassStudent::query()->find($classStudentId)->update($request);
    }
}
