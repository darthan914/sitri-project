<?php


namespace App\Sitri\Actions\Student;


use App\Sitri\Models\Admin\ClassSchedule;
use App\Sitri\Models\Admin\ClassStudent;
use App\Sitri\Models\Admin\Student;
use App\Sitri\Repositories\User\UserRepositoryInterface;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class StoreStudentAction
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $data
     *
     * @param bool  $isTrial
     *
     * @return Builder|Model
     */
    public function execute(array $data, $isTrial = false)
    {
        $user = $this->userRepository->getUserByEmail($data['parent_email']);

        $dataParent = [
            'name'  => $data['parent_name'],
            'email' => $data['parent_email'],
            'phone' => $data['parent_phone'],
        ];

        if (!$user) {
            $dataParent['password'] = bcrypt(str_random());
            $user = User::query()->create($dataParent);
        } else {
            User::query()->find($user['id'])->update($dataParent);
        }

        $data['user_id'] = $user->id;
        $data['is_trial'] = $isTrial;

        $student = Student::query()->create($data);

        $classSchedule = ClassSchedule::query()
                                      ->where('class_room_id', $data['class_room_id'])
                                      ->where('day', $data['day'])
                                      ->where('start_time', config('sitri.time')[$data['day']]['start_time'])
                                      ->where('end_time', config('sitri.time')[$data['day']]['end_time'])
                                      ->first()
        ;


        $dataClassSchedule = [
            'class_room_id' => $data['class_room_id'],
            'day'           => $data['day'],
            'start_time'    => config('sitri.time')[$data['day']]['start_time'],
            'end_time'      => config('sitri.time')[$data['day']]['end_time'],
            'teacher_name'  => $data['teacher_name'],
            'active'        => 1,
        ];

        if (!$classSchedule) {
            $dataParent['password'] = bcrypt(str_random());
            $classSchedule = ClassSchedule::query()->create($dataClassSchedule);
        } else {
            ClassSchedule::query()->find($classSchedule['id'])->update($dataClassSchedule);
        }



        ClassStudent::query()->updateOrCreate(['student_id' => $student->id], ['class_schedule_id' => $classSchedule->id]);

        return $student;
    }
}
