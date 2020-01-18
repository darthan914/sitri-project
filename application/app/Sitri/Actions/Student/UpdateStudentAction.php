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

class UpdateStudentAction
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
     * UpdateStudentAction constructor.
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
     * @param int   $studentId
     * @param array $data
     * @param bool  $isTrial
     *
     * @return bool
     * @throws Exception
     */
    public function execute($studentId, array $data, $isTrial = false)
    {
        (new CreateOrUpdateStudentParentAction)->execute($data);
        $data['is_trial'] = $isTrial;

        $return = Student::query()->find($studentId)->update($data);
        $classSchedule = (new StoreClassScheduleAction())->execute($data);

        $maxStudent = $this->classRoomRepository->getMaxStudent($data['class_room_id']);
        $classStudentCount = $this->classStudentRepository->countClassStudent($classSchedule['id'], $studentId);

        if ($maxStudent < $classStudentCount + 1) {
            throw new Exception('Class room is full');
        }

        ClassStudent::query()->updateOrCreate(
            ['student_id' => $studentId],
            ['class_schedule_id' => $classSchedule['id'], 'teacher_name' => $data['teacher_name']]
        )
        ;

        return $return;
    }
}
