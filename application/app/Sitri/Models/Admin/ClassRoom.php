<?php

namespace App\Sitri\Models\Admin;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 */
class ClassRoom extends Model
{
    protected $fillable = ['name', 'active', 'max_student'];
}
