<?php


namespace App\Sitri\Repositories\ClassRoom;


use App\Sitri\Interfaces\ActiveInterface;
use App\Sitri\Interfaces\DataInterface;

interface ClassRoomRepositoryInterface
{
    /**
     * @param array $with
     *
     * @return array
     */
    public function all(array $with = []);

    /**
     * @param int   $classRoomId
     * @param array $with
     *
     * @return array
     */
    public function find($classRoomId, array $with = []);

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
     * @param int $classRoomId
     *
     * @return int
     */
    public function getMaxStudent($classRoomId);

}
