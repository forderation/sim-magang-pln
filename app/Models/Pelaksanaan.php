<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelaksanaan extends Model
{
    //
    protected $guarded = [];

    public function magang(){
        return $this->belongsTo(Magang::class,'magang_id');
    }

    public function surat_terbit(){
        return $this->belongsTo(SuratTerbit::class,'surat_pelaksanaan_id');
    }
}