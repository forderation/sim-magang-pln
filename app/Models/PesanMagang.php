<?php

namespace App\Models;

use App\Admin;
use Illuminate\Database\Eloquent\Model;

class PesanMagang extends Model
{
    //
    protected $guarded = [];

    public function magang(){
        return $this->belongsTo(Magang::class,'magang_id');
    }

    public function admin(){
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}