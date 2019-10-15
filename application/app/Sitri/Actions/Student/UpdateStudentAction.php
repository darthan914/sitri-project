<?php


namespace App\Sitri\Actions\Student;


use App\Sitri\Models\Admin\Student;
use App\Sitri\Repositories\User\UserRepositoryInterface;
use App\User;

class UpdateStudentAction
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
     * @param Student $student
     * @param array   $data
     *
     * @param bool    $isTrial
     *
     * @return bool
     */
    public function execute(Student $student, array $data, $isTrial = false)
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

        return $student->update($data);
    }
}
