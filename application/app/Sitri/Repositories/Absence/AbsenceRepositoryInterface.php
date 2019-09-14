<?php


namespace App\Sitri\Repositories\Absence;


use App\Sitri\Interfaces\ActiveInterface;
use App\Sitri\Interfaces\DataInterface;

interface AbsenceRepositoryInterface extends DataInterface
{
    public function getStudentList($classScheduleId, $date);
}
