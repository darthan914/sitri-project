<?php


namespace App\Sitri\Actions\ClassStudent;


use App\Sitri\Models\Admin\ClassStudent;
use Exception;

class DeleteClassStudentAction
{
    /**
     * @param int $classStudentId
     *
     * @return bool
     * @throws Exception
     */
    public function execute($classStudentId)
    {
        return ClassStudent::query()->find($classStudentId)->delete();
    }
}
