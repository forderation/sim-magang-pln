<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Admin as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable, SoftDeletes;
    protected $hidden = ['password', 'remember_token'];
    protected $fillable = [
        'full_name',
        'email',
    ];

    public function give_sertifikat(){
        return $this->hasMany('App\Models\Sertifikat','admin_id');
    }

    public function give_pelaksanaan(){
        return $this->hasMany('App\Models\Pelaksanaan','admin_id');
    }

    public function pesan_magang(){
        return $this->hasMany('App\Models\PesanMagang','admin_id');
    }


}
