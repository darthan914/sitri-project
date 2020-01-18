<?php


namespace app\Sitri\Actions\Student;


use App\Sitri\Repositories\User\UserRepositoryInterface;
use App\User;

class CreateOrUpdateStudentParentAction
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(array &$data)
    {
        $user = $this->userRepository->getUserByEmail($data['parent_email']);

        $dataParent = [
            'name'  => $data['parent_name'],
            'email' => $data['parent_email'],
            'phone' => $data['parent_phone'],
        ];

        if (null !== $user) {
            User::query()->find($user['id'])->update($dataParent);
        } else {
            $dataParent['password'] = bcrypt(str_random());
            $user = User::query()->create($dataParent)->toArray();
        }

        $data['user_id'] = $user['id'];
    }
}
