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
        return Student::query()->orderBy('name')->where('is_trial', 0)->get();
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

        $isTrial = $collect->get('is_trial');

        if (null !== $isTrial && 1 == $isTrial) {
            $student->where('is_trial', 1)->withoutGlobalScope('isActive');
        } else {
            $student->where('is_trial', 0);
        }

        return $student->orderBy('name')->get();
    }

    public function getStudentNotOnSchedule()
    {
        return Student::query()->doesntHave('classStudents')->get();
    }

    public function getStudentOnTrial()
    {
        return Student::query()->where('is_trial', 1)->get();
    }
}
