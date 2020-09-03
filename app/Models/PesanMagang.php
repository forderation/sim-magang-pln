<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesanMagang extends Model {
    
    public function magang(){
        return $this->belongsTo('App\Models\Magang','magang_id');
    }

    public function admin(){
        return $this->belongsTo('App\Models\Admin','admin_id');
    }
    
}