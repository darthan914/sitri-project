<?php

namespace App\Sitri\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'can', 'active'];

    public function setCanAttribute($value)
    {
        $this->attributes['can'] = json_encode($value);
    }

    public function getCanAttribute($value)
    {
        return json_decode($value, true);
    }
}
