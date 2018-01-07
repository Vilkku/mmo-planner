<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Raid extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at', 'start_time', 'end_time'];

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function signups()
    {
        return $this->hasMany('App\Signup');
    }

    public function charactersByRole()
    {
        $charactersByRole = array();

        foreach ($this->characters as $character) {
            if (!isset($charactersByRole[$character->role_id])) {
                $charactersByRole[$character->role_id] = array();
            }

            $charactersByRole[$character->role_id][] = $character;
        }

        return $charactersByRole;
    }
}
