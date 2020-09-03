<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model {
    
    public function surat_terbit(){
        return $this->belongsTo('App\Models\SuratTerbit','surat_sertifikat_id');
    }

    public function magang(){
        return $this->belongsTo('App\Models\Magang','magang_id');
    }

    public function admin(){
        return $this->belongsTo('App\Models\Admin','admin_id');
    }
    
}