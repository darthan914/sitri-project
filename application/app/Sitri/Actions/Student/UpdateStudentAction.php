<?php


namespace App\Sitri\Actions\Student;


use App\Sitri\Models\Admin\Student;

class UpdateStudentAction
{
    /**
     * @param Student $student
     * @param array   $data
     *
     * @return Student
     */
    public function execute(Student $student, array $data)
    {
        $student->user_id = $data['user_id'];
        $student->name = $data['name'];

        $student->save();

        return $student;
    }
}
