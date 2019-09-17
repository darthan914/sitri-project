<?php


namespace App\Sitri\Repositories\ClassStudent;


use App\Sitri\Models\Admin\ClassStudent;

class ClassStudentRepository implements ClassStudentRepositoryInterface
{

    /**
     * @return mixed
     */
    public function all()
    {
        return ClassStudent::query()->get();
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function getByRequest(array $data)
    {
        $classStudent = ClassStudent::query();

        $collect = collect($data);

        $search = $collect->get('f_search');
        if (null !== $search && '' !== $search) {
            $classStudent->whereHas('student', function ($student) use ($search) {
                $student->where('name', 'like', '%' . $search . '%');
            });
        }

        $student = $collect->get('f_student');
        if (null !== $student) {
            $classStudent->where('student_id', $student);
        }

        return $classStudent->get();
    }
}
