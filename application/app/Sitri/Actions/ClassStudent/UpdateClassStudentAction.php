<?php


namespace App\Sitri\Actions\ClassStudent;


use App\Sitri\Models\Admin\ClassStudent;
use Exception;

class UpdateClassStudentAction
{
    /**
     * @param ClassStudent $classStudent
     * @param array        $request
     *
     * @return ClassStudent
     * @throws Exception
     */
    public function execute(ClassStudent $classStudent, array $request)
    {
        $check = ClassStudent::query()->where('class_schedule_id', $request['class_schedule_id'])
                             ->where('student_id', $request['student_id'])
                             ->where('id', '<>', $classStudent->id)->first()
        ;

        if (isset($check)) {
            throw new Exception('Class student already exist');
        }

        $classStudent->class_schedule_id = $request['class_schedule_id'];
        $classStudent->student_id = $request['student_id'];

        $classStudent->save();

        return $classStudent;
    }
}