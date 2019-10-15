<?php


namespace App\Sitri\Actions\Trial;


use App\Sitri\Models\Admin\ChildTrial;
use App\Sitri\Models\Admin\ClassStudent;
use App\Sitri\Models\Admin\ParentTrial;
use App\Sitri\Models\Admin\Student;
use App\Sitri\Repositories\User\UserRepositoryInterface;
use App\User;

class StoreTrialAction
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
     * @return bool
     */
    public function execute(array $data)
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
        $data['is_trial'] = 1;


        if (is_array($data['name']) && is_array($data['class_schedule_id'])) {
            foreach ($data['name'] as $key => $childName) {
                if (isset($childName) && isset($data['class_schedule_id'][$key])) {
                    $student = [
                        'user_id'           => $user->id,
                        'name'              => $childName,
                        'is_trial'          => 1,
                    ];
                    $studentId = Student::query()->create($student)->id;

                    $classStudent = [
                        'class_schedule_id' => $data['class_schedule_id'][$key],
                        'student_id' => $studentId,
                    ];
                    ClassStudent::query()->create($classStudent);
                }
            }
        }

        return true;
    }
}
