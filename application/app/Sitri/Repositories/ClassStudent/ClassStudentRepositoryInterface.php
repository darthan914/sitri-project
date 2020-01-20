<?php


namespace App\Sitri\Repositories\ClassStudent;


use App\Sitri\Interfaces\ActiveInterface;
use App\Sitri\Interfaces\DataInterface;

interface ClassStudentRepositoryInterface
{
    /**
     * @param array $with
     *
     * @return array
     */
    public function all(array $with = []);

    /**
     * @param int   $classStudentId
     * @param array $with
     *
     * @return array
     */
    public function find($classStudentId, array $with = []);

    /**
     * @param array $request
     * @param array $with
     *
     * @return array
     */
    public function getByRequest(array $request, array $with = []);

    /**
     * @param int      $classScheduleId
     * @param int|null $exceptStudentId
     *
     * @return int
     */
    public function countClassStudent($classScheduleId, $exceptStudentId = null);

    /**
     * @param int $classScheduleId
     *
     * @return array
     */
    public function getStudentByClassScheduleId($classScheduleId);

    /**
     * @param int $studentId
     *
     * @return string
     */
    public function getFirstTeacherName($studentId);
}
