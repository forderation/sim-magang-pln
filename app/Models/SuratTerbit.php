<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratTerbit extends Model {

    public function sertifikat(){
        return $this->hasOne('App\Models\Sertifikat  ','surat_sertifikat_id');
    }

    public function pelaksanaan(){
        return $this->hasOne('App\Models\Pelaksanaan  ','surat_pelaksanaan_id');
    }
    
}