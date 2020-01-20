<?php


namespace App\Sitri\Repositories\ClassStudent;


use App\Sitri\Models\Admin\ClassStudent;

class ClassStudentRepository implements ClassStudentRepositoryInterface
{
    /**
     * @param array $with
     *
     * @return array
     */
    public function all(array $with = [])
    {
        return ClassStudent::query()->with($with)->get()->toArray();
    }

    /**
     * @param int   $classStudentId
     * @param array $with
     *
     * @return array
     */
    public function find($classStudentId, array $with = [])
    {
        return ClassStudent::query()->with($with)->find($classStudentId)->toArray();
    }

    /**
     * @param array $request
     * @param array $with
     *
     * @return array
     */
    public function getByRequest(array $request, array $with = [])
    {
        $classStudent = ClassStudent::query()->with($with);

        $collect = collect($request);

        $student = $collect->get('f_student');
        if (null !== $student) {
            $classStudent->where('student_id', $student);
        }

        return $classStudent->get()->toArray();
    }

    /**
     * @param int      $classScheduleId
     * @param int|null $exceptStudentId
     *
     * @return int
     */
    public function countClassStudent($classScheduleId, $exceptStudentId = null)
    {
        $classStudents = ClassStudent::query()->where('class_schedule_id', $classScheduleId);

        if (null !== $exceptStudentId) {
            $classStudents->where('student_id', '<>', $exceptStudentId)->count();
        }

        return $classStudents->count();
    }

    /**
     * @inheritDoc
     */
    public function getStudentByClassScheduleId($classScheduleId)
    {
        return ClassStudent::query()
                           ->with('student')
                           ->where('class_schedule_id', $classScheduleId)
                           ->get()
                           ->toArray();
    }
}
