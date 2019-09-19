<?php

namespace App\Sitri\Models\Admin;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property User user
 */
class Student extends Model
{
    protected $fillable = ['user_id', 'name'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('isActive', function (Builder $builder) {
            $builder->whereHas('user', function (Builder $user) {
                $user->where('active', 1);
            });
        });
    }


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

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function isReschedule($date)
    {
        return $this->reschedules()->where('from_date', $date)->count() !== 0;
    }
}
