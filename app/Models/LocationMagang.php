<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationMagang extends Model {

    public function magang(){
        return $this->belongsTo('App\Models\Magang','location_magang_id');
    }
}