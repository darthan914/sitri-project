<?php


namespace App\Sitri\Repositories\ClassSchedule;


use App\Sitri\Interfaces\ActiveInterface;
use App\Sitri\Interfaces\DataInterface;

interface ClassScheduleRepositoryInterface
{
    public function all(array $with = []);

    public function find($id, array $with =[]);

    public function getByRequest(array $request, array $with = []);

    public function getActive($active = true);

    public function getIsTrial($active = true);
}
