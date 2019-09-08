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
}
