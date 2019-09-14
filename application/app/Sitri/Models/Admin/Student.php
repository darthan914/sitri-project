<?php

namespace App\Sitri\Models\Admin;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['user_id', 'name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classStudents()
    {
        return $this->hasMany(ClassStudent::class);
    }

    public function reschedules()
    {
        return $this->hasMany(Reschedule::class);
    }

    public function isReschedule($date)
    {
        return $this->reschedules()->where('from_date', $date)->count() !== 0;
    }
}
