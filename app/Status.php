<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function signups()
    {
        return $this->hasMany('App\Signup');
    }
}
