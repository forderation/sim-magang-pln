<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Magang extends Model {

    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function location_magang(){
        return $this->hasOne('App\Models\LocationMagang','location_magang_id');
    }

    public function pesan_magang(){
        return $this->hasMany('App\Models\PesanMagang','magang_id');
    }

    public function sertifikat(){
        return $this->hasOne('App\Models\Sertifikat','magang_id');
    }

    public function pelaksanaan(){
        return $this->hasOne('App\Models\Pelaksanaan','magang_id');
    }

}