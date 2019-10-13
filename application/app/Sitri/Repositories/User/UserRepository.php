<?php


namespace App\Sitri\Repositories\User;


use App\User;
use Illuminate\Http\Request;

class UserRepository implements UserRepositoryInterface
{

    /**
     * @param bool $active
     *
     * @return mixed
     */
    public function getIsActive($active)
    {
        return User::query()
                   ->where('active', $active)
                   ->orderBy('name')
                   ->get()
            ;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return User::query()
                   ->orderBy('name')
                   ->get()
            ;
    }

    /**
     * @param array
     *
     * @return mixed
     */
    public function getByRequest(array $data)
    {
        $user = User::query();

        $collect = collect($data);

        $search = $collect->get('f_search');
        if (null !== $search && '' !== $search) {
            $user->where(function ($user) use ($search) {
                $user->where('name', 'like', '%' . $search . '%')
                     ->orWhere('email', 'like', '%' . $search . '%')
                ;
            });
        }

        $active = $collect->get('f_active');
        if (null !== $active && '' !== $active) {
            $user->where('active', $active);
        }

        return $user->orderBy('name')->get();
    }

    public function getUserByEmail($email)
    {
        return User::query()->where('email', $email)->first();
    }
}
