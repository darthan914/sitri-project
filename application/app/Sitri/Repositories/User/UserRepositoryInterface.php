<?php


namespace App\Sitri\Repositories\User;


use App\Sitri\Interfaces\ActiveInterface;
use App\Sitri\Interfaces\DataInterface;

interface UserRepositoryInterface extends DataInterface, ActiveInterface
{
    public function getUserByEmail($email);
}
