<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $guarded = [];

    public function leadings(){
        return $this->hasMany(Magang::class, 'lead_id');
    }

    public function userGroups(){
        return $this->hasMany(Group::class, 'user_id');
    }

    public function magangs(){
        return $this->belongsToMany(Magang::class,'groups');
    }
    
}
