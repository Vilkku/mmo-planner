<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Charclass extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function characters()
    {
        return $this->hasMany('App\Character');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function slug()
    {
        return strtolower(str_replace(' ', '', $this->name));
    }
}
