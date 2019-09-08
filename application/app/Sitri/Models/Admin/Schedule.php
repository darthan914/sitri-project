<?php

namespace App\Sitri\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function getSchedule()
    {
        return config('sitri.day')[$this->day] . ' (' . $this->start_time . ' - ' . $this->end_time . ')';
    }
}
