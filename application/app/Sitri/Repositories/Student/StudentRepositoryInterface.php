<?php

namespace App\Sitri\Repositories\Student;

use App\Sitri\Interfaces\DataInterface;

interface StudentRepositoryInterface
{
    /**
     * @param array $with
     *
     * @return array
     */
    public function all(array $with = []);

    /**
     * @param int   $studentId
     * @param array $with
     *
     * @return array
     */
    public function find($studentId, array $with = []);

    /**
     * @param array $request
     * @param array $with
     *
     * @return array
     */
    public function getByRequest(array $request, array $with = []);

    /**
     * @param array $with
     *
     * @return array
     */
    public function getStudentsNotOnSchedule(array $with = []);

    /**
     * @param bool  $trial
     * @param array $with
     *
     * @return array
     */
    public function getStudentsOnTrial($trial = true, array $with = []);
}
