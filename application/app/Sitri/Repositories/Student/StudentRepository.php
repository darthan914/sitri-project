<?php


namespace App\Sitri\Repositories\Student;


use App\Sitri\Models\Admin\Student;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class StudentRepository implements StudentRepositoryInterface
{

    /**
     * @param array $with
     *
     * @return array
     */
    public function all(array $with = [])
    {
        return Student::query()->with($with)->orderBy('name')->get()->toArray();
    }

    /**
     * @param int   $studentId
     * @param array $with
     *
     * @return array
     */
    public function find($studentId, array $with = [])
    {
        return Student::query()->with($with)->find($studentId)->orderBy('name')->get()->toArray();
    }

    /**
     * @param array $request
     * @param array $with
     *
     * @return mixed
     */
    public function getByRequest(array $request, array $with = [])
    {
        $student = Student::query();

        $collect = collect($request);

        $isTrial = $collect->get('is_trial');
        if (null !== $isTrial && 1 == $isTrial) {
            $student->where('is_trial', 1);
        } else {
            $student->where('is_trial', 0);
        }

        return $student->orderBy('name')->get()->toArray();
    }

    /**
     * @param array $with
     *
     * @return array
     */
    public function getStudentsNotOnSchedule(array $with = [])
    {
        return Student::query()->with($with)->doesntHave('classStudents')->get()->toArray();
    }

    /**
     * @param bool  $trial
     * @param array $with
     *
     * @return array
     */
    public function getStudentsOnTrial($trial = true, array $with = [])
    {
        return Student::query()->with($with)->where('is_trial', $trial)->get()->toArray();
    }
}
