<?php

namespace App\Sitri\Models\Admin;

use Illuminate\Database\Eloquent\Model;

/**
 * @property array can
 */
class Role extends Model
{
    const ROLE_MASTER = 1;

    const ROLE_ADMIN = 2;
    
    const ROLE_PARENT = 3;

    protected $fillable = ['name', 'can', 'active'];

    public function setCanAttribute($value)
    {
        $this->attributes['can'] = json_encode($value);
    }

    public function getCanAttribute($value)
    {
        return null === $value ? [] : json_decode($value, true);
    }
}
