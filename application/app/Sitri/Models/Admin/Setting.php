<?php


namespace App\Sitri\Models\Admin;


use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['value'];

    protected $primaryKey = 'key';

    public $incrementing = false;

    public $timestamps = false;
}
