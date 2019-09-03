<?php


namespace App\Sitri\Actions\Student;


use App\Sitri\Models\Admin\Student;

class StoreStudentAction
{
    /**
     * @param array $data
     *
     * @return Student
     */
    public function execute(array $data)
    {
        $student = new Student();
        $student->user_id = $data['user_id'];
        $student->name = $data['name'];

        $student->save();

        return $student;
    }
}
