<?php

namespace App\Sitri\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    protected $fillable = ['class_schedule_id', 'date'];

    protected $with = ['absenceDetails'];

    public function absenceDetails()
    {
        return $this->hasMany(AbsenceDetail::class);
    }

    public function classSchedule()
    {
        return $this->belongsTo(ClassSchedule::class);
    }
}
