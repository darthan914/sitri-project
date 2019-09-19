<?php

namespace App\Sitri\Models\Admin;

use Illuminate\Database\Eloquent\Model;

/**
 * @property Student student
 */
class Payment extends Model
{
    protected $fillable = ['no_payment', 'student_id', 'value', 'date_paid', 'note'];

    public function student()
    {
        return $this->belongsTo(Student::class)->withoutGlobalScope('isActive');
    }
}
