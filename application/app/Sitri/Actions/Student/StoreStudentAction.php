<?php


namespace App\Sitri\Actions\Student;


use App\Sitri\Actions\ClassSchedule\StoreClassScheduleAction;
use App\Sitri\Models\Admin\ClassRoom;
use App\Sitri\Models\Admin\ClassSchedule;
use App\Sitri\Models\Admin\ClassStudent;
use App\Sitri\Models\Admin\Student;
use App\Sitri\Repositories\ClassRoom\ClassRoomRepositoryInterface;
use App\Sitri\Repositories\ClassStudent\ClassStudentRepositoryInterface;
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
    /**
     * @var ClassRoomRepositoryInterface
     */
    private $classRoomRepository;
    /**
     * @var ClassStudentRepositoryInterface
     */
    private $classStudentRepository;

    /**
     * StoreStudentAction constructor.
     *
     * @param UserRepositoryInterface         $userRepository
     * @param ClassRoomRepositoryInterface    $classRoomRepository
     * @param ClassStudentRepositoryInterface $classStudentRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        ClassRoomRepositoryInterface $classRoomRepository,
        ClassStudentRepositoryInterface $classStudentRepository
    ) {
        $this->userRepository = $userRepository;
        $this->classRoomRepository = $classRoomRepository;
        $this->classStudentRepository = $classStudentRepository;
    }

    /**
     * @param array $data
     * @param bool  $isTrial
     *
     * @return array
     * @throws Exception
     */
    public function execute(array $data, $isTrial = false)
    {
        (new CreateOrUpdateStudentParentAction($this->userRepository))->execute($data);
        $data['is_trial'] = $isTrial;

        $student = Student::query()->create($data);
        $classSchedule = (new StoreClassScheduleAction())->execute($data);

        $maxStudent = $this->classRoomRepository->getMaxStudent($data['class_room_id']);
        $classStudentCount = $this->classStudentRepository->countClassStudent($classSchedule['id']);

        if ($maxStudent < $classStudentCount + 1) {
            throw new Exception('Class room is full');
        }

        ClassStudent::query()->updateOrCreate(['student_id' => $student->id],
            ['class_schedule_id' => $classSchedule['id'], 'teacher_name' => $data['teacher_name']])
        ;

        return $student->toArray();
    }
}
