<?php


namespace App\Sitri\Actions\Student;


use App\Sitri\Actions\ClassSchedule\StoreClassScheduleAction;
use App\Sitri\Models\Admin\ClassRoom;
use App\Sitri\Models\Admin\ClassSchedule;
use App\Sitri\Models\Admin\ClassStudent;
use App\Sitri\Models\Admin\Student;
use App\Sitri\Repositories\User\UserRepositoryInterface;
use App\User;
use Exception;
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
     * @throws Exception
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
        $classSchedule = (new StoreClassScheduleAction())->execute($data);

        $classRoom = ClassRoom::query()->find($data['class_room_id']);
        $classStudentCount = ClassStudent::query()->where('class_schedule_id', $classSchedule->id)->count();

        if ($classRoom->max_student < $classStudentCount + 1) {
            throw new Exception('Class room is full');
        }

        ClassStudent::query()->updateOrCreate(['student_id' => $student->id],
            ['class_schedule_id' => $classSchedule->id, 'teacher_name' => $data['teacher_name']])
        ;

        return $student;
    }
}
