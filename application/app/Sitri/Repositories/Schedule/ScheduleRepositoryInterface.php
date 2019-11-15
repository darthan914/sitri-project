<?php


namespace App\Sitri\Repositories\Schedule;


use App\Sitri\Interfaces\ActiveInterface;
use App\Sitri\Interfaces\DataInterface;

interface ScheduleRepositoryInterface extends DataInterface, ActiveInterface
{
    public function listDayActive();

    /**
     * @param $day
     *
     * @return mixed
     */
    public function getScheduleByDay($day);
}
