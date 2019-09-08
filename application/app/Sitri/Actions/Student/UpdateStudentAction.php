<?php


namespace App\Sitri\Actions\Student;


use App\Sitri\Models\Admin\Student;

class UpdateStudentAction
{
    /**
     * @param Student $student
     * @param array   $data
     *
     * @return bool
     */
    public function execute(Student $student, array $data)
    {
        return $student->update($data);
    }
}
