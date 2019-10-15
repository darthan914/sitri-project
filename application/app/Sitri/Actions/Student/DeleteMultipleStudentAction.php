<?php


namespace App\Sitri\Actions\Student;


use App\Sitri\Models\Admin\Student;
use Exception;

class DeleteMultipleStudentAction
{
    /**
     * @param $ids
     *
     * @return bool
     * @throws Exception
     */
    public function execute($ids)
    {
        if(!is_array($ids)) {
            return false;
        }

        return Student::destroy($ids);
    }
}
