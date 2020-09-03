<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;
    protected $hidden = ['password', 'remember_token'];
    protected $fillable = [
        'full_name',
        'no_induk',
        'jurusan',
        'sekolah',
        'gender',
        'email'
    ];

    public function magang(){
        return $this->hasMany('App\Models\Magang','user_id');
    }
}
