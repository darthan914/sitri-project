<?php


namespace App\Sitri\Repositories\User;


use App\Sitri\Interfaces\ActiveInterface;
use App\Sitri\Interfaces\DataInterface;

interface UserRepositoryInterface
{
    /**
     * @param array $with
     *
     * @return array
     */
    public function all(array $with = []);

    /**
     * @param int   $id
     * @param array $with
     *
     * @return array
     */
    public function find($id, array $with = []);

    /**
     * @param array $request
     * @param array $with
     *
     * @return array
     */
    public function getByRequest(array $request, array $with = []);

    /**
     * @param bool $active
     *
     * @return array
     */
    public function getActive($active = true);

    /**
     * @param string $email
     *
     * @return array
     */
    public function getUserByEmail($email);
}
