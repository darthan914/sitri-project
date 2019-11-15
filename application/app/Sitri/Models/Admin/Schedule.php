<?php

namespace App\Sitri\Models\Admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int    day
 * @property string start_time
 * @property string end_time
 */
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

    public function classSchedules()
    {
        return $this->hasMany(ClassSchedule::class);
    }
}
