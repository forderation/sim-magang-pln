<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    //
    protected $guarded = [];

    public function location_magang(){
        return $this->belongsTo(LocationMagang::class,'location_magang_id');
    }

    public function magangs(){
        return $this->hasMany(Magang::class,'divisi_id');
    }
}