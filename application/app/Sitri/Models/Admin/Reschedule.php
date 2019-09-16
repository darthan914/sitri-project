<?php

namespace App\Sitri\Models\Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Reschedule extends Model
{
    //

    protected $fillable = [
        'student_id',
        'from_date',
        'from_class_schedule_id',
        'to_date',
        'to_class_schedule_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('isActive', function (Builder $builder) {
            $builder->whereHas('student', function (Builder $student) {
                $student->whereHas('user', function (Builder $user) {
                    $user->where('active', 1);
                });
            });
        });
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function fromClassSchedule()
    {
        return $this->belongsTo(ClassSchedule::class,'from_class_schedule_id');
    }

    public function toClassSchedule()
    {
        return $this->belongsTo(ClassSchedule::class, 'to_class_schedule_id');
    }
}
