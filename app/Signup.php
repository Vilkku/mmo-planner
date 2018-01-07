<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Signup extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function character()
    {
        return $this->belongsTo('App\Character');
    }

    public function raid()
    {
        return $this->belongsTo('App\Raid');
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }
}
