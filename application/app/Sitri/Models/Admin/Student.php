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
}
