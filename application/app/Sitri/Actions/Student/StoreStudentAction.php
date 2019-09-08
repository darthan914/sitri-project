<?php


namespace App\Sitri\Actions\Student;


use App\Sitri\Models\Admin\Student;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class StoreStudentAction
{
    /**
     * @param array $data
     *
     * @return Builder|Model
     */
    public function execute(array $data)
    {
        return Student::query()->create($data);
    }
}
