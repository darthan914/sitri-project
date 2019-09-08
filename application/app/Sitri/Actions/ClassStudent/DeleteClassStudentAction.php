<?php


namespace App\Sitri\Actions\ClassStudent;


use App\Sitri\Models\Admin\ClassStudent;
use Exception;

class DeleteClassStudentAction
{
    /**
     * @param ClassStudent $classStudent
     *
     * @return bool
     * @throws Exception
     */
    public function execute(ClassStudent $classStudent)
    {
        $classStudent->delete();

        return true;
    }
}
