<?php

namespace App\Sitri\Models\Admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'no_payment',
        'student_id',
        'registration_value',
        'monthly_value',
        'day_off_value',
        'shopping_value',
        'date_paid',
        'note',
        'type_payment'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class)->withoutGlobalScope('isActive');
    }

    public function getTotalAttribute()
    {
        return $this->registration_value + $this->monthly_value + $this->day_off_value + $this->shopping_value;
    }

    public function getStatusPayment()
    {
        if($this->date_paid === null) {
            return '';
        }

        return Carbon::parse($this->date_paid)->format('d.m.y') . ' ('. $this->type_payment .')';
    }
}
