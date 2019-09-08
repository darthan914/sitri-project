<?php

namespace App\Sitri\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ClassStudent extends Model
{
    protected $fillable = ['student_id', 'class_schedule_id'];

    public function classSchedule()
    {
        return $this->belongsTo(ClassSchedule::class, 'class_schedule_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
