<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Character extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['name'];

    public function charclass()
    {
        return $this->belongsTo('App\Charclass');
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function roles()
    {
        return $this->hasManyThrough('App\Role', 'App\Charclass');
    }

    public function signups()
    {
        return $this->hasMany('App\Signup');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
