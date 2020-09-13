<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    //
    protected $guarded = [];

    public function magang(){
        return $this->belongsTo(Magang::class, 'magang_id');
    }

    public function surat_terbit(){
        return $this->belongsTo(SuratTerbit::class, 'surat_sertifikat_id');
    }

    public function admin(){
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}