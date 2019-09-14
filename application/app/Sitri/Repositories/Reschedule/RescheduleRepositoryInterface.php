<?php


namespace App\Sitri\Repositories\Reschedule;


use App\Sitri\Interfaces\ActiveInterface;
use App\Sitri\Interfaces\DataInterface;

interface RescheduleRepositoryInterface extends DataInterface
{
    public function getRegularStudentScheduleByDate($studentId, $date);

    public function getRescheduleStudentAvailableByDate($studentId, $toDate, $fromDate);
}
