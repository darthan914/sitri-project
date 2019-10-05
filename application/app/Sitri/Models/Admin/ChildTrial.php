<?php

namespace App\Sitri\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ChildTrial extends Model
{
    protected $fillable = ['name', 'class_schedule_id', 'school', 'age', 'updated_at'];

    public function parentTrial()
    {
        return $this->belongsTo(ParentTrial::class);
    }

    public function classSchedule()
    {
        return $this->belongsTo(ClassSchedule::class);
    }
}
