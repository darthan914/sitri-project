<?php

namespace App\Sitri\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ParentTrial extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'updated_at'];

    public function childTrials()
    {
        return $this->hasMany(ChildTrial::class);
    }
}
