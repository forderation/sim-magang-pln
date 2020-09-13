<?php

namespace App;

use App\Models\Pelaksanaan;
use App\Models\PesanMagang;
use App\Models\Sertifikat;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{

    protected $fillable = [
        'full_name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sertifikats(){
        return $this->hasMany(Sertifikat::class, 'admin_id');
    }

    public function pelaksanaans(){
        return $this->hasMany(Pelaksanaan::class, 'admin_id');
    }

    public function pesan_magangs(){
        return $this->hasMany(PesanMagang::class, 'admin_id');
    }

}
