<?php


namespace App\Sitri\Repositories\Absence;


use App\Sitri\Interfaces\ActiveInterface;
use App\Sitri\Interfaces\DataInterface;

interface AbsenceRepositoryInterface
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
     * @param int    $classScheduleId
     * @param string $date
     *
     * @return array
     */
    public function getStudentList($classScheduleId, $date);

    /**
     * @param int    $studentId
     * @param string $date
     *
     * @return string
     */
    public function getStatusStudentAbsence($studentId, $date);
}
