<?php


namespace App\Sitri\Actions\ClassStudent;


use App\Sitri\Models\Admin\ClassSchedule;
use App\Sitri\Models\Admin\ClassStudent;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class StoreClassStudentAction
{
    /**
     * @param array $request
     *
     * @return array
     */
    public function execute(array $request)
    {
        return ClassStudent::query()->create($request)->toArray();
    }
}
