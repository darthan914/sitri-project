<?php


namespace App\Sitri\Repositories\Student;


use App\Sitri\Models\Admin\Student;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class StudentRepository implements StudentRepositoryInterface
{

    /**
     * @return mixed
     */
    public function all()
    {
        return Student::query()->orderBy('name')->get();
    }


    /**
     * @param array $data
     *
     * @return mixed
     */
    public function getByRequest(array $data)
    {
        $student = Student::query();

        $collect = collect($data);

        $search = $collect->get('f_search');
        if (null !== $search && '' !== $search) {
            $student->where(function ($student) use ($search) {
                $student->where('name', 'like', '%' . $search . '%')
                        ->orWhereHas('user', function (Builder $query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        })
                ;
            });
        }

        return $student->orderBy('name')->get();
    }
}
