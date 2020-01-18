<?php

namespace App\Sitri\Models\Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property ClassSchedule classSchedule
 */
class ClassStudent extends Model
{
    protected $fillable = ['student_id', 'class_schedule_id', 'teacher_name'];


    public function classSchedule()
    {
        return $this->belongsTo(ClassSchedule::class, 'class_schedule_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
