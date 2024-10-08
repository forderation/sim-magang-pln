<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
    //
    protected $guarded = [];

    // public function location_magang(){
    //     return $this->belongsTo(LocationMagang::class);
    // }

    public function leader(){
        return $this->belongsTo(User::class, 'lead_id');
    }

    public function sertifikat(){
        return $this->hasOne(Sertifikat::class,'magang_id');
    }

    public function pelaksanaan(){
        return $this->hasOne(Pelaksanaan::class,'magang_id');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'groups');
    }

    public function divisi(){
        return $this->belongsTo(Divisi::class, 'divisi_id');
    }

    
}