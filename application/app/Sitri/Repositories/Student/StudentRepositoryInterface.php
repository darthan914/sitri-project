<?php

namespace App\Sitri\Repositories\Student;

use App\Sitri\Interfaces\DataInterface;

interface StudentRepositoryInterface extends DataInterface
{
    public function getStudentNotOnSchedule();

    public function getStudentOnTrial();
}
