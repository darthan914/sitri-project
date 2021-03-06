<?php


namespace App\Sitri\Repositories\Reschedule;


use App\Sitri\Interfaces\ActiveInterface;
use App\Sitri\Interfaces\DataInterface;

interface RescheduleRepositoryInterface
{
    /**
     * @param array $with
     *
     * @return array
     */
    public function all(array $with = []);

    /**
     * @param int   $rescheduleId
     * @param array $with
     *
     * @return array
     */
    public function find($rescheduleId, array $with = []);

    /**
     * @param array $request
     * @param array $with
     *
     * @return array
     */
    public function getByRequest(array $request, array $with = []);

    /**
     * @param int    $studentId
     * @param string $date
     *
     * @return array
     */
    public function getRegularStudentScheduleByDate($studentId, $date);

    /**
     * @param int    $studentId
     * @param string $toDate
     * @param string $fromDate
     *
     * @return array
     */
    public function getRescheduleStudentAvailableByDate($studentId, $toDate, $fromDate);

    /**
     * @param int $studentId
     *
     * @return array
     */
    public function getDayStudentAvailable($studentId);

    /**
     * @param string $date
     * @param int $classScheduleId
     *
     * @return array
     */
    public function getStudentRescheduleToByDateAndClassSchedule($date, $classScheduleId);

    /**
     * @param int $studentId
     * @param string $date
     * @param int $classScheduleId
     *
     * @return bool
     */
    public function isStudentOnReschedule($studentId, $date, $classScheduleId);
}
