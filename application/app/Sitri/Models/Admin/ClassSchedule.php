<?php

namespace App\Sitri\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
    protected $fillable = ['class_room_id', 'schedule_id', 'active'];

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function classStudents()
    {
        return $this->hasMany(ClassStudent::class);
    }


    public function getClassInfo()
    {
        return 'Class ' . $this->classRoom->name . ' : ' . $this->schedule->getSchedule();
    }
}
