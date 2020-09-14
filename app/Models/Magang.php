<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Magang extends Model
{
    //
    protected $guarded = [];

    public function location_magang(){
        return $this->belongsTo(LocationMagang::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function pesan_magangs(){
        return $this->hasMany(PesanMagang::class,'magang_id');
    }

    public function sertifikat(){
        return $this->hasOne(Sertifikat::class,'magang_id');
    }

    public function pelaksanaan(){
        return $this->hasOne(Pelaksanaan::class,'magang_id');
    }

    
}