<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratTerbit extends Model
{
    //
    protected $guarded = [];

    public function sertifikat(){
        return $this->hasOne(Sertifikat::class,'surat_sertifikat_id');
    }

    public function pelaksanaan(){
        return $this->hasOne(Pelaksanaan::class,'surat_pelaksanaan_id');
    }
    
}