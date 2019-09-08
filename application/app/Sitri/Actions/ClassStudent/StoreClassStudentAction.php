<?php


namespace App\Sitri\Actions\ClassStudent;


use App\Sitri\Models\Admin\ClassStudent;
use Exception;

class StoreClassStudentAction
{
    /**
     * @param array $request
     *
     * @return ClassStudent
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


        $classStudent = new ClassStudent();

        $classStudent->class_schedule_id = $request['class_schedule_id'];
        $classStudent->student_id = $request['student_id'];

        $classStudent->save();

        return $classStudent;
    }
}
