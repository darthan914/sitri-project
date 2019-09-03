<?php


namespace app\Sitri\Actions\Student;


use App\Sitri\Models\Admin\Student;
use Exception;

class DeleteStudentAction
{
    /**
     * @param Student $student
     *
     * @return bool
     * @throws Exception
     */
    public function execute(Student $student)
    {
        $student->delete();

        return true;
    }
}
