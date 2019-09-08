<?php

namespace App\Sitri\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function getSchedule()
    {
        return config('sitri.day')[$this->schedule->day] . ' (' . $this->schedule->start_time . ' - ' . $this->schedule->end_time . ')';
    }

    public function getClassInfo()
    {
        return 'Class ' . $this->classRoom->name . ' : ' . $this->getSchedule();
    }
}
