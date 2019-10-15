<?php

namespace App\Sitri\Models\Admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['day', 'start_time', 'end_time', 'active'];

    public function getSchedule()
    {
        return config('sitri.day')[$this->day] . ' (' . $this->start_time . ' - ' . $this->end_time . ')';
    }

    public function getStartTimeAttribute($value)
    {
        return Carbon::parse($value)->format('H:i');
    }

    public function getEndTimeAttribute($value)
    {
        return Carbon::parse($value)->format('H:i');
    }

    public function getClassSchedulesAttribute()
    {
        return ClassSchedule::query()
                            ->where('day', $this->day)
                            ->where('start_time', $this->start_time)
                            ->where('end_time', $this->end_time)->get()
            ;
    }
}
