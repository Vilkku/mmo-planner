<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function charclasses()
    {
        return $this->belongsToMany('App\Charclass');
    }

    public function characters()
    {
        return $this->hasMany('App\Character');
    }

    public function signups()
    {
        return $this->hasMany('App\Signup');
    }
}
