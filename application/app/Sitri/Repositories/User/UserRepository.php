<?php


namespace App\Sitri\Repositories\User;


use App\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param array $with
     *
     * @return array
     */
    public function all(array $with = [])
    {
        return User::query()->with($with)->orderBy('name')->get()->toArray();
    }

    /**
     * @param int   $id
     * @param array $with
     *
     * @return array
     */
    public function find($id, array $with = [])
    {
        return User::query()->with($with)->find($id)->toArray();
    }

    /**
     * @param array $request
     * @param array $with
     *
     * @return array
     */
    public function getByRequest(array $request, array $with = [])
    {
        $user = User::query()->with($with);

        $collect = collect($request);

        $active = $collect->get('f_active');
        if (null !== $active && '' !== $active) {
            $user->where('active', $active);
        }

        return $user->orderBy('name')->get()->toArray();
    }

    /**
     * @param bool $active
     *
     * @return array
     */
    public function getActive($active = true)
    {
        return User::query()->where('active', $active)->orderBy('name')->get()->toArray();
    }

    /**
     * @param string $email
     *
     * @return array
     */
    public function getUserByEmail($email)
    {
        $user = User::query()->where('email', $email)->first();

        if(null === $user){
            return null;
        }

        return $user->toArray();
    }
}
