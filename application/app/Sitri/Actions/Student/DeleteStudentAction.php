<?php


namespace App\Sitri\Actions\Student;


use App\Sitri\Models\Admin\Student;
use Exception;

class DeleteStudentAction
{
    /**
     * @param int $studentId
     *
     * @return bool
     * @throws Exception
     */
    public function execute($studentId)
    {
        return Student::query()->find($studentId)->delete();
    }
}
