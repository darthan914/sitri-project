<?php


namespace App\Sitri\Actions\Student;


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

        return Student::query()->create($data);
    }
}
