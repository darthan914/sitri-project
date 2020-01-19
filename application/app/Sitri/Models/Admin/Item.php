<?php

namespace App\Sitri\Models\Admin;

use Illuminate\Database\Eloquent\Model;

/**
 * @property ClassStudent classStudent
 */
class Item extends Model
{
    protected $fillable = ['name', 'value'];
}
