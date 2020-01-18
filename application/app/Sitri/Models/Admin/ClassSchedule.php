<?php

namespace App\Sitri\Models\Admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property ClassRoom classRoom
 * @property Schedule  schedule
 */
class ClassSchedule extends Model
{
    protected $fillable = ['class_room_id', 'schedule_id', 'is_trial', 'active'];

    protected $appends = ['class_info', 'schedule_info'];

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function classStudents()
    {
        return $this->hasMany(ClassStudent::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function getScheduleInfoAttribute()
    {
        return config('sitri.day')[$this->schedule->day] . ' (' . $this->schedule->start_time . ' - ' . $this->schedule->end_time . ')';
    }

    public function getClassInfoAttribute()
    {
        return 'Class ' . $this->classRoom->name . ' : ' . $this->schedule_info;
    }

    public function getStartTimeAttribute($value)
    {
        return Carbon::parse($value)->format('H:i');
    }

    public function getEndTimeAttribute($value)
    {
        return Carbon::parse($value)->format('H:i');
    }
}
