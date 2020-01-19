<?php


namespace App\Sitri\Repositories\Schedule;


use App\Sitri\Interfaces\ActiveInterface;
use App\Sitri\Interfaces\DataInterface;

interface ScheduleRepositoryInterface
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
     * @return array
     */
    public function getActiveDay();

    /**
     * @param int $day 0 - 6 Sunday to Saturday
     *
     * @return array
     */
    public function getScheduleByDay($day);

}
