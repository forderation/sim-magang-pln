<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\User;
use Symfony\Component\HttpFoundation\Request;

class PesertaMagangController extends Controller
{
    public function index(){
        $pesertas = User::all();
        return view('admins.peserta', compact('pesertas'));
    }

    public function detail($id){

    }
}