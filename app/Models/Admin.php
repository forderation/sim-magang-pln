<?php

namespace App\Models;

use App\Models\Pelaksanaan;
use App\Models\PesanMagang;
use App\Models\Sertifikat;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{

    protected $fillable = [
        'full_name', 'email', 'password'
    ];
    
    public function sertifikats(){
        return $this->hasMany(Sertifikat::class, 'admin_id');
    }

    public function pelaksanaans(){
        return $this->hasMany(Pelaksanaan::class, 'admin_id');
    }

}
