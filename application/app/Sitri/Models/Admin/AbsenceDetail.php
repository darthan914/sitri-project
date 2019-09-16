<?php

namespace App\Sitri\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AbsenceDetail extends Model
{
    protected $fillable = ['absence_id', 'student_id', 'status'];

    public function absence()
    {
        return $this->belongsTo(Absence::class);
    }

    public function student()
    {
        return$this->belongsTo(Student::class)->withoutGlobalScope('isActive');
    }
}
