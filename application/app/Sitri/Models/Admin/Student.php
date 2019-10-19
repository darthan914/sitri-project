<?php

namespace App\Sitri\Models\Admin;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property ClassStudent classStudent
 */
class Student extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'birthday',
        'school',
        'grade',
        'address',
        'is_trial',
        'recommendation',
        'age',
        'date_enter',
    ];

    protected static function boot()
    {
        parent::boot();

//        static::addGlobalScope('isActive', function (Builder $builder) {
//            $builder->whereHas('user', function (Builder $user) {
//                $user->where('active', 1);
//            })->orWhere('is_trial', 1);
//        });
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classStudents()
    {
        return $this->hasMany(ClassStudent::class);
    }

    public function classStudent()
    {
        return $this->hasOne(ClassStudent::class);
    }

    public function reschedules()
    {
        return $this->hasMany(Reschedule::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function isReschedule($date)
    {
        return $this->reschedules()->where('from_date', $date)->count() !== 0;
    }

    public function setRecommendationAttribute($value)
    {
        $this->attributes['recommendation'] = json_encode($value);
    }

    public function getRecommendationAttribute($value)
    {
        return json_decode($value, true);
    }

    public function getClassScheduleAttribute()
    {
        return $this->classStudent->classSchedule ?? [];
    }
}
