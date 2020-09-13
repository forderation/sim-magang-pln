<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationMagang extends Model
{
    //
    protected $guarded = [];

    public function magangs(){
        return $this->hasMany(Magang::class,'location_magang_id');
    }
}