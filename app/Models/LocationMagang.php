<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationMagang extends Model
{
    //
    protected $guarded = [];

    public function divisis(){
        return $this->hasMany(Divisi::class,'location_magang_id');
    }
}