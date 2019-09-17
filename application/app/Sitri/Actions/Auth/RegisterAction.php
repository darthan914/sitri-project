<?php


namespace App\Sitri\Actions;


use App\Sitri\Models\Admin\Student;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RegisterAction
{
    /**
     * @param array $request
     *
     * @return Builder|Model
     */
    public function execute(array $request)
    {
        $request['password'] = bcrypt($request['password']);
        $request['token_verify'] = str_random();

        $students = [];
        if (is_array($request['student_name'])) {
            foreach ($request['student_name'] as $studentName) {
                if (isset($studentName)) {
                    $students[] = new Student(['name' => $studentName]);
                }
            }
        }

        return User::query()->create($request)->students()->saveMany($students);
    }
}
