<?php

namespace App\Sitri\Models\Admin;

use Illuminate\Database\Eloquent\Model;

/**
 * @property ClassRoom classRoom
 * @property integer   day
 * @property string    start_time
 * @property string    end_time
 */
class ClassSchedule extends Model
{
    protected $fillable = ['class_room_id', 'day', 'start_time', 'end_time', 'is_trial', 'active'];

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function classStudents()
    {
        return $this->hasMany(ClassStudent::class);
    }

    public function getSchedule()
    {
        return config('sitri.day')[$this->day] . ' (' . $this->start_time . ' - ' . $this->end_time . ')';
    }

    public function getClassInfo()
    {
        return 'Class ' . $this->classRoom->name . ' : ' . $this->getSchedule();
    }
}
