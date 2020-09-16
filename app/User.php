<?php

namespace App;

use App\Models\Magang;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'full_name', 'no_induk', 'jurusan', 'sekolah', 'gender', 'email', 'password'
    ];

    public function magangs(){
        return $this->hasMany(Magang::class, 'user_id');
    }
    
}
